<?php $this->view('shared/header',_('List of Service Appointments for the client')); ?>

<!-- IDENTIFY THE CLIENT -->
<?php $this->view('Client/detailsPartial', $data); ?>

<a href='/Service/create/<?= $data->client_id ?>'> <?= _('Create a new Service Appointment') ?> </a>

<table>
	<!-- th = table heading -->
	<tr><th><?= _('Date and Time') ?></th><th><?= _('Description') ?></th><th><?= _('Actions') ?></th></tr>
<?php
	// $data is an array of client objects
	$services = $data->getServices();

	foreach ($services as $service) { ?>
		
		<tr>
			<td><?= \app\core\TimeHelper::DTOutput($service->datetime) ?></td> 
			<!-- TODO: output the internationalied date -->
			<td><?= $service->description ?></td> 
			<td>
				<a href='/Service/delete/<?=$service->client_id?>'><?= _('delete') ?></a> | 
				<a href='/Service/edit/<?=$service->client_id?>'><?= _('edit') ?></a> 

			</td>
		</tr>
		
<?php
}
?>
	
</table>

<?php $this->view('shared/footer'); ?>