<?php $this->view('shared/header',_('List of Clients')); ?>

<a href="/Client/create"> <?= _('Create a new client record') ?> </a>

<table>
	<!-- th = table heading -->
	<tr><th><?= _('First name') ?></th><th><?= _('Last name') ?></th><th><?= _('Middle name') ?></th><th><?= _('action') ?></th></tr>
<?php
	// $data is an array of client objects
	foreach ($data as $client) { ?>
		
		<tr>
			<td><?= htmlentities($client->first_name) ?></td> 
			<td><?= htmlentities($client->last_name) ?></td> 
			<td><?= htmlentities($client->middle_name) ?></td> 
			<td>
				<a href='/Client/delete/<?=$client->client_id?>'><?= _('delete') ?></a> | 
				<a href='/Client/edit/<?=$client->client_id?>'><?= _('edit') ?></a> | 
				<!-- pass client id to the service/index so that you nly see that one clients records -->
				<a href='/Service/index/<?=$client->client_id?>'><?= _('service') ?></a>
			</td>
		</tr>
		
<?php
}
?>
	
</table>

<?php $this->view('shared/footer'); ?>