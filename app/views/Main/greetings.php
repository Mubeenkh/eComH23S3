<?php $this->view('shared/header','Greetings' . $data); ?>
	<!-- These two do the same thing -->
	Hi <?= $data ?>!<br>
	Hi <?php echo $data; ?>!<br>
<?php $this->view('shared/footer'); ?>