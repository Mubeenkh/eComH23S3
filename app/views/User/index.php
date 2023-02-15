<?php $this->view('shared/header','Login into you Account'); ?>

<form method="post" action="">
	<label>Username:</label><input type="text" name="username"><br><br>
	<label>Password:</label><input type="password" name="password"><br><br>
	<input type="submit" name="action" value="Login">

	Don't already have an Account?<a href="/User/register">Register</a>
</form>

<?php $this->view('shared/footer'); ?>