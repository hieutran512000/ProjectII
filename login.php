<?php
include 'includes/header.php';
include 'func/account.php';
?>

<div class="container mt-3">

	<!-- Error Section -->
	<?php if (isset($errorMsg)) : ?>
		<div class="alert alert-danger" role="alert">
			<?php echo $errorMsg; ?>
		</div>
	<?php endif; ?>
	<!-- Error Section -->

	<div class="row">
		<!-- Login Wrapper -->
		<div class="col-md-6">
			<h3>Login</h3>
			<hr>
			<form class="" action="login.php" method="post">
				<label for="username">Username</label>
				<input type="text" name="username" class="form-control" placeholder="Input your username..." value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
				<p class="error">
					<?php if (isset($errors['login_username'])) {
						echo $errors['login_username'];
					} ?>
				</p>

				<label for="password">Password</label>
				<input type="password" name="password" class="form-control" placeholder="Input your username..." value="">

				<p class="error">
					<?php if (isset($errors['login_password'])) {
						echo $errors['login_password'];
					} ?>
				</p>
				<button id="button5" type="submit" name="login" class="btn btn-outline-primary">Login</button>
			</form>


		</div>
		<!-- Login Wrapper -->

		
		<!-- Register Wrapper -->
		<div class="col-md-6">

			<h3>Create a new account</h3>
			<hr>

			<!-- Register Form -->
			<form class="" action="login.php" method="post">

				<label for="username">Username</label>

				<input type="text" name="username" class="form-control" placeholder="Input your username..." value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">

				<p class="error">
					<?php if (isset($errors['create_username'])) {
						echo $errors['create_username'];
					} ?>
				</p>

				<label for="email">Email</label>
				<input type="email" name="email" class="form-control" placeholder="Input your email..." value="
						<?php if (isset($email)) {
							echo htmlspecialchars($email);
						} ?>">

				<p class="error">
					<?php if (isset($errors['create_email'])) {
						echo $errors['create_email'];
					} ?>
				</p>

				<label for="password1">Password</label>
				<input type="password" name="password1" class="form-control" placeholder="Input your password..." value="">

				<p class="error"></p>

				<label for="password2">Confirm Password</label>
				<input type="password" name="password2" class="form-control" placeholder="Input your confirm password..." value="">
				<p class="error">
					<?php if (isset($errors['create_password'])) {
						echo $errors['create_password'];
					} ?>
				</p>
				<button type="submit" name="create" class="btn btn-outline-success">Create Account</button>

			</form>
			<!-- Register Form -->

		</div>
		<!-- Register Wrapper -->

		

	</div>
</div>

<?php
// $adminpass = "itec2021";
// echo $adminpass . "<br>";
// echo password_hash($adminpass, PASSWORD_DEFAULT);
include 'includes/footer.php';
?>