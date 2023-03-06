<?php $this->view('shared/header','Your Profile'); ?>

	<div class="d-flex flex-row card">

		<div class="p-2">
			<img style="max-width:200px;" src="/images/<?=$data->picture?>">
		</div>

		<div class="p-2">

			<dl>
				<dt>First Name</dt>
				<dd><?=$data->first_name?></dd>

				<dt>Last Name</dt>
				<dd><?=$data->last_name?></dd>

				<dt>Middle Name</dt>
				<dd><?=$data->middle_name?></dd>

			</dl>
		</div>
		
	</div>


	<a href="/Profile/edit">Edit my profile</a>
	<a href="/User/profile">Back</a>


<?php $this->view('shared/footer'); ?>