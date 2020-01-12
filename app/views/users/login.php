<?php require_once (APPROOT . '/views/inc/header.php'); ?>

<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card card-body bg-light mt-5">
			<?php flash('register_success'); ?>
			<h2>Login</h2>
			<p>Please fill in your credentials to log in</p>

			<form action="<?= URLROOT; ?>/users/login" method="post">
	        	<input type="hidden" name="formLogin">

				<div class="form-group">
					<label for="username">Username: <sup>*</sup></label>
					<input type="text" name="username" class="form-control form-control-lg <?= (!empty($data['logging_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['username']; ?>">
				</div>
				
				<div class="form-group">
					<label for="password">Password: <sup>*</sup></label>
					<input type="password" name="password" class="form-control form-control-lg <?= (!empty($data['logging_err'])) ? 'is-invalid' : ''; ?>" >
					<br>
					<span class="invalid-feedback"><?= $data['logging_err']; ?></span>
				</div>
				
				<div class="row">
					<div class="col">
						<input type="submit" value="Login" class="btn btn-success btn-block">
					</div>
					<div class="col">
						<a href="<?= URLROOT; ?>/users/register" class="btn btn-light btn-block">No account? Register</a>
					</div>
				</div>

			</form>

		</div>
	</div>
</div>

<?php require_once (APPROOT . '/views/inc/footer.php'); ?>