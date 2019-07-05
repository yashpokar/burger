<?php

namespace Burger\Database;

use PDO;
use Exception;

class QueryBuilder
{
	protected $_columns = ['*'];

	protected $_table = '';

	protected $_query = '';

	protected $_where = [];

	protected $_whereClause = '';

	protected $_pdo = null;

	protected static $_instance = null;

	protected static $QUERIES = [
		'SELECT' => 'SELECT `:columns` FROM `:table`:where',
		'INSERT' => 'INSERT INTO `:table` (`:columns`) VALUES (:values)',
		'UPDATE' => 'UPDATE `:table` SET :changes:where',
		'DELETE' => 'DELETE FROM `:table`:where',
	];

	private function __construct()
	{
		$this->_pdo = Connector::makeConnection();
	}

	/**
	 * get singleton connection
	 * @return \Burger\Database\QueryBuilder
	 */
	public static function getConnection()
	{
		if (! isset(self::$_instance)) {
			self::$_instance = new static();
		}

		self::$_instance->_where = [];
		self::$_instance->_stmt = null;
		self::$_instance->_whereClause = '';
		self::$_instance->_query = '';
		self::$_instance->_table = '';
		self::$_instance->_columns = ['*'];

		return self::$_instance;
	}

	/**
	 * Execute the query
	 * @param  String $query
	 * @param  array  $params
	 * @return \Burger\Database\QueryBuilder
	 */
	public function execute($query, array $params = [])
	{
		if (! $this->_stmt = $this->_pdo->prepare($query)) {
			throw new Exception("Something went wrong with database");
		}

		$position = 1;
		$params = array_merge($params, $this->_where);

		if (count($params)) {
			foreach ($params as $param) {
				$this->_stmt->bindValue($position, $param);
				$position++;
			}
		}

		if (! $this->_stmt->execute()) {
			throw new Exception("Something went wrong with database");
		}

		return $this;
	}

	/**
	 * build a query binding where caluse as of now
	 * @return String
	 */
	public function buildQuery()
	{
		$whereClause = '';

		if ($this->_whereClause) {
			$whereClause = " WHERE {$this->_whereClause}";
		}

		return str_replace(':where', $whereClause, $this->_query);
	}

	/**
	 * Select sepecific columns
	 * @param  array $columns
	 * @return \Burger\Database\QueryBuilder
	 */
	public function select(...$columns)
	{
		$this->_columns = $columns;

		return $this;
	}

	/**
	 * Setter for tablename
	 * @param  String $tableName
	 * @return \Burger\Database\QueryBuilder
	 */
	public function table($tableName)
	{
		$this->_table = $tableName;

		return $this;
	}

	/**
	 * Count records
	 * @return int
	 */
	public function count()
	{
		return $this->get()->rowCount();
	}

	/**
	 * Does record exists
	 * @return Boolean
	 */
	public function exists()
	{
		return (bool) $this->count();
	}

	/**
	 * build and execute query for search helper
	 * @return PDO
	 */
	protected function get()
	{
		$this->_query = str_replace(
			[':table', ':columns'],
			[$this->_table, implode('`, `', $this->_columns)],
			self::$QUERIES['SELECT']
		);

		return $this->execute($this->buildQuery())->_stmt;
	}

	/**
	 * get the first record
	 * @return PDO
	 */
	public function first()
	{
		return $this->get()->fetch(PDO::FETCH_OBJ);
	}

	public function find(int $id)
	{
		return $this->where('id', $id)->first();
	}

	/**
	 * retrive all records for search query
	 * @return PDO
	 */
	public function all()
	{
		return $this->get()->fetchAll(PDO::FETCH_OBJ);
	}

	/**
	 * Insert a record
	 * @param  array  $data
	 * @return \Burger\Database\QueryBuilder
	 */
	public function insert(array $data)
	{
		$values = trim(
			str_repeat('?, ', count($data)),
		', ');

		$this->_query = str_replace(
			[':table', ':columns', ':values'],
			[$this->_table, implode('`, `', array_keys($data)), $values],
			self::$QUERIES['INSERT']
		);

		return $this->execute($this->buildQuery(), $data);
	}

	/**
	 * Update record(s)
	 * @param  array  $data
	 * @return \Burger\Database\QueryBuilder
	 */
	public function update(array $data)
	{
		$changes = array_map(function($key){
			return "`{$key}` = ?";
		}, array_keys($data));

		$changes = implode(', ', $changes);

		$this->_query = str_replace(
			[':table', ':changes'],
			[$this->_table, $changes],
			self::$QUERIES['UPDATE']
		);

		return $this->execute($this->buildQuery(), $data);
	}

	/**
	 * Delete record(s)
	 * @return \Burger\Database\QueryBuilder
	 */
	public function delete()
	{
		$this->_query = str_replace(
			[':table'],
			[$this->_table],
			self::$QUERIES['DELETE']
		);

		return $this->execute($this->buildQuery());
	}

	/**
	 * bind "or" where condition
	 * @param  array $condition
	 * @return \Burger\Database\QueryBuilder::prepareWhereStatement
	 */
	public function orWhere(...$condition)
	{
		if (empty($this->_whereClause)) {
			throw new Exception("Invalid query syntax formation");
		}

		return $this->prepareWhereStatement('OR', ...$condition);
	}

	/**
	 * bind "and" where condition
	 * @param  array $condition
	 * @return \Burger\Database\QueryBuilder::prepareWhereStatement
	 */
	public function where(...$condition)
	{
		return $this->prepareWhereStatement('AND', ...$condition);
	}

	/**
	 * prepares the where statement
	 * @param  String $joiner
	 * @param  array $condition
	 * @return \Burger\Database\QueryBuilder
	 */
	protected function prepareWhereStatement($joiner, ...$condition)
	{
		$operator = '=';

		if (count($condition) == 2) {
			[$fieldName, $value] = $condition;
		} else if (count($condition) == 3) {
			[$fieldName, $operator, $value] = $condition;
		} else {
			throw new Exception("Received extra parameters than required.");
		}

		if (! empty($this->_whereClause)) {
			$this->_whereClause .= " ";
		}

		$this->_whereClause .= "{$joiner} `{$fieldName}` {$operator} ?";
		$this->_whereClause = trim($this->_whereClause, 'AND');

		$this->_where[] = $value;

		return $this;
	}
}
