<?php $this->view('shared/header', _('Edit Service Appointment')); ?>

<!-- i need to get the GETTEXT to output all the language strings -->
<!-- Change everything that the user see -->
<!-- The shorter version (allias) of gettext() is the underscore ( _ ) -->
<?php
	$service = $data['service'];
	$branches = $data['branches'];
?>

<?php $this->view('Client/detailsPartial', $service->getClient()); ?>

<form method="post" action="">

	<label><?= _('Description:') ?></label>
	<textarea name="description"> <?= $service->description ?> </textarea>
	<br><br>

	<label><?= _('Appointment date and time:')?></label>
	<input type="datetime-local" name="datetime" value="<?= \app\core\TimeHelper::DTOutBrowser($service->datetime); ?>"><br><br>

	<label><?= _('Select the appointment location:') ?> </label> 
	<select name='branch_id'>
		<?php
		foreach ($branches as $branch) {
			echo "<option value='$branch->branch_id' ";
			echo ($branch->branch_id == $service->branch_id?'selected':'');
			//		(comparison ? if true : if false)
			echo "> $branch->name </option>\n";

		}
		?>
	</select>
	<br><br>


	<input type="submit" name="action" value='<?= _('Modify') ?>'>
	<a href="/Service/index/<?= $service->client_id ?>"><?= _('Cancel') ?></a>
</form>
<br>
<?php $this->view('shared/footer'); ?>