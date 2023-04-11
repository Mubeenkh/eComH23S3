<?php $this->view('shared/header', _('Delete a Service Appointment')); ?>

<!-- i need to get the GETTEXT to output all the language strings -->
<!-- Change everything that the user see -->
<!-- The shorter version (allias) of gettext() is the underscore ( _ ) -->

<p>Do you want to delete the service appointment presented on this screen?</p>

<?php
	$client = $data->getClient();
	$this->view('Client/detailsPartial', $client);
?>

<?php $this->view('Service/detailsPartial', $data); ?>

<form method="post" action="">

	<input type="submit" name="action" value='<?= _('Delete') ?>'>
	<a href="/Service/index/<?= $data->client_id ?>"><?= _('Cancel') ?></a>

</form>

<?php $this->view('shared/footer'); ?>