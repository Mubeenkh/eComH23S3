<?php $this->view('shared/header','Register your Account'); ?>

<form method="post" action="">
	<label>Username:</label><input type="text" name="username"><br><br>
	<label>Password:</label><input type="password" name="password"><br><br>
	<input type="submit" name="action" value="Register">

	Already have an Account?<a href="/User/index">Login</a>
</form>

<?php $this->view('shared/footer'); ?>