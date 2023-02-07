<?php $this->view('shared/header','User Log List'); ?>
<table>
	<tr><th>Log Entry</th><th>Actions</th></tr>
<?php
	foreach ($data as $key=>$logEntry) { ?>
		<!-- nl2br(string) == make a new line with br -->
		<!-- echo $logEntry; -->
		<!-- <tr><td><?php	echo nl2br($logEntry); ?></td></tr> -->
		<tr><td><?= $logEntry?></td> <td><a href='/Main/logDelete/<?=$key?>'>Delete</a></td></tr>
		
<?php
}
?>
	
</table>

<?php $this->view('shared/footer'); ?>