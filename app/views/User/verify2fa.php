<?php $this->view('shared/header','Verification'); ?>
	
	<div class="card p-4 mt-4">
		<div class="row">

			<div class="col-sm ">
				<p class="text-center">Verify you thing buddy</p>

				<form method="post" action="" class="text-center">

					<label>Current code: <input type="text" name="currentCode"></label>
					<input type="submit" name="action" value="Verify code">
				</form>
			</div>
		</div>
	</div>
</body>
</html>