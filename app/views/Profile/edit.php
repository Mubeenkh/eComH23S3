<?php $this->view('shared/header','Edit Your Profile'); ?>

<form action="" method="post">
	
	<div class="form-group row">
		<label class="col-sm-2 col-form-label">First Name:</label>
		<div class="col-sm-10">
			<input class="form-control" type="text" name="first_name" value='<?=$data->first_name?>'>
		</div>
		<br><br>
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Last Name:</label>
		<div class="col-sm-10">
			<input class="form-control" name="last_name" value='<?=$data->last_name?>'></input>
		</div>
		<br><br>
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Middle Name:</label>
		<div class="col-sm-10">
			<input class="form-control" name="middle_name" value='<?=$data->middle_name?>'></input>
		</div>
		<br><br>
	</div>

	<input  type="submit" name="action" value="Save Changes">
</form>

	<a href="/Profile/index">Back</a>


<?php $this->view('shared/footer'); ?>