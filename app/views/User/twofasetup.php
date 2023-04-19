<?php $this->view('shared/header','2-factor Authentification'); ?>
	
	<div class="card p-4 mt-4">
		<div class="row">

			<!-- <div style="width: 100; height: 100;">
				<img  class="img-thumbnail" src="/User/makeQRCode?data=<?=$data ?>">
			</div> -->

			<!-- <div class="col-sm text-center"> -->
			 	<img style="height: 100; max-width:100;" src="/User/makeQRCode?data=<?=$data ?>" class="col-sm img-thumbnail">
			<!-- </div> -->

			<div class="col-sm ">
				<p>Please scan the QR-code on the screen with your favorite
				Authenticator software, such as Google Authenticator. The
				authenticator software will generate codes that are valid for 30
				seconds only. Enter such a code while and submit it while it is
				still valid to confirm that the 2-factor authentication can be
				applied to your account.</p>

				<form method="post" action="" class="text-center">

					<label>Current code: <input type="text" name="currentCode"></label>
					<input type="submit" name="action" value="Verify code">
				</form>
			</div>
		</div>
	</div>
</body>
</html>