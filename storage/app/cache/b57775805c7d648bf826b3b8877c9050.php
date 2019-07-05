<!doctype html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <title>Sign Up</title>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-7 mt-5 mx-auto">
					<div class="card">
						<div class="card-header">
							Register
						</div>

						<div class="card-body">
							<form method="POST">
								<div class="row">
									<div class="col-md-6">
										<input
											type="hidden"
											name="<?=  config('session.token_name')  ?>"
											value="<?=  \Burger\Form\Token::generate()  ?>"
										/>

										<div class="form-group">
											<label for="first_name">First name</label>
											<input type="text" class="form-control<?=  $errors->has('first_name') ? ' is-invalid' : ''  ?>" id="first_name" name="first_name" value="<?=  old('first_name') ?: ''  ?>">

											<?php if ($errors->has('first_name')) : ?>
												<div class="invalid-feedback"><?=  $errors->first('first_name')  ?></div>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="last_name">Last name</label>
											<input type="text" class="form-control<?=  $errors->has('last_name') ? ' is-invalid' : ''  ?>" id="last_name" name="last_name"  value="<?=  old('last_name') ?: ''  ?>">

											<?php if ($errors->has('last_name')) : ?>
												<div class="invalid-feedback"><?=  $errors->first('last_name')  ?></div>
											<?php endif; ?>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="email">Email address</label>
									<input type="email" class="form-control<?=  $errors->has('email') ? ' is-invalid' : ''  ?>" id="email" name="email" value="<?=  old('email') ?: ''  ?>">

									<?php if ($errors->has('email')) : ?>
										<div class="invalid-feedback"><?=  $errors->first('email')  ?></div>
									<?php endif; ?>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control<?=  $errors->has('password') ? ' is-invalid' : ''  ?>" id="password" name="password" value="<?=  old('password') ?: ''  ?>">

									<?php if ($errors->has('password')) : ?>
										<div class="invalid-feedback"><?=  $errors->first('password')  ?></div>
									<?php endif; ?>
								</div>

								<div class="form-group">
									<label for="confirm_password">Confirm Password</label>
									<input type="password" class="form-control<?=  $errors->has('confirm_password') ? ' is-invalid' : ''  ?>" id="confirm_password" name="confirm_password" value="<?=  old('confirm_password') ?: ''  ?>">

									<?php if ($errors->has('confirm_password')) : ?>
										<div class="invalid-feedback"><?=  $errors->first('confirm_password')  ?></div>
									<?php endif; ?>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Create new Account</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>
