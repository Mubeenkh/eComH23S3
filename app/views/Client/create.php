<?php $this->view('shared/header', _('Create a New Client Record')); ?>

<!-- i need to get the GETTEXT to output all the language strings -->
<!-- Change everything that the user see -->
<!-- The shorter version (allias) of gettext() is the underscore ( _ ) -->
<form method="post" action="">
	<label><?= _('First Name:') ?></label><input type="text" name="first_name"><br><br>
	<label><?= _('Last Name:')?></label><input type="text" name="last_name"><br><br>
	<label><?= _('Middle Name:')?></label><input type="text" name="middle_name"><br><br>
	<input type="submit" name="action" value='<?= _('Create') ?>'>

	<a href="/Client/index"><?= _('Cancel') ?></a>
</form>

<?php $this->view('shared/footer'); ?>