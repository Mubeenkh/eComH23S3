<?php $this->view('shared/header','Create Your Profile'); ?>

<form action="" method="post">
	
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">First Name:</label>
		<div class="col-sm-10">
			<input class="form-control" type="text" name="first_name">
		</div>
		<br>
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Last Name:</label>
		<div class="col-sm-10">
			<input class="form-control" name="last_name"></input>
		</div>
		<br>
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Middle Name:</label>
		<div class="col-sm-10">
			<input class="form-control" name="middle_name"></input>
		</div>
		<br>
	</div>

	<input  type="submit" name="action" value="Create profile">
</form>

	<a href="/Profile/index">Back</a>


<?php $this->view('shared/footer'); ?>