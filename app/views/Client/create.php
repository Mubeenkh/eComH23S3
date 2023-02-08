<?php $this->view('shared/header','Create a New Client Record'); ?>

<form method="post" action="">
	<label>First Name:</label><input type="text" name="first_name"><br><br>
	<label>Last Name:</label><input type="text" name="last_name"><br><br>
	<label>Middle Name:</label><input type="text" name="middle_name"><br><br>
	<input type="submit" name="action" value="create">

	<a href="/Client/index">Cancel</a>
</form>

<?php $this->view('shared/footer'); ?>