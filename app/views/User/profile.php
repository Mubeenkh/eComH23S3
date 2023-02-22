<?php $this->view('shared/header','Register your Account'); ?>

USER PROFILE!! 
<a href="/Profile/index">See My Profile</a>

<h1>Messages</h1>

<h2>My Messages</h2>
<table class="container px-4">
	<tr><th>sender</th> <th>receiver</th><th>message</th><th>time</th><th>actions</th></tr>
	<?php 
		// display all messages
		foreach ($data as $message) {
			echo "<tr>
					<td>$message->sender_name</td>
					<td>$message->receiver_name</td>
					<td>$message->message</td>
					<td>$message->timestamp</td>
					<td><a href='/Message/delete/$message->message_id'>DELETE</a></td>
				</tr>";
		}
	?>
</table>
<br><br>
<h2>Send a message</h2>
<p>Send a message using the folling form</p>
<form action='/Message/send' method="post" >

	<div class="form-group row">
		<label class="col-sm-2 col-form-label">TO:</label>
		<div class="col-sm-10">
			<input class="form-control" type="text" name="receiver">
		</div>
		<br><br>
	</div>

	<div class="form-group row">
		<label class="col-sm-2 col-form-label">Message:</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="message"></textarea>
		</div>
		<br><br>
	</div>
	<br>
	<input  type="submit" name="action" value="Send Message">
</form>

<a href='/User/logout'> Sign out </a>

<br><br><br><br>
<?php $this->view('shared/footer'); ?>
