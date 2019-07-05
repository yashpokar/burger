<?php

namespace Burger\Template;

class Template
{
	protected $_filename = '';
	protected $_content = '';

	public function __construct($filename)
	{
		$this->_filename = $filename;
		$this->_content = file_get_contents(__DIR__ . "/../../resources/views/{$filename}.view.php");
	}

	public function render()
	{
		return $this->build()->saveAndEchoTemplate();
	}

	public function build()
	{
		$this->_content = preg_replace('/\{\{([^\}]+)\}\}/', '<?= \1 ?>', $this->_content);
		$this->_content = preg_replace('/@(if|foreach)\s*\(([^\n]+)\)/', '<?php \1 (\2) : ?>', $this->_content);
		$this->_content = preg_replace('/@end(if|foreach)/', '<?php end\1; ?>', $this->_content);

		return $this;
	}

	public function saveAndEchoTemplate()
	{
		$newFileName = __DIR__ . '/../../storage/app/cache/' . md5($this->_filename) . '.php';
		file_put_contents($newFileName, $this->_content);

		return $newFileName;
	}
}
