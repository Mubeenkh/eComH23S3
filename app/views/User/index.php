<?php $this->view('shared/header','Login into you Account'); ?>
<!-- <section class="h-100 gradient-form" style="background-color: #eee;"> -->

	<div class="container py-5 h-100">
	    <div class="row d-flex justify-content-center align-items-center h-100">
	      	<div class="col-xl-10">
	        	<div class="card rounded-3 text-black">
	          		<div class="row g-0">
	            		<div class="col-lg-6">
	              			<div class="card-body p-md-5 mx-md-4">
								<form method="post" action="">

									<div class="form-outline mb-4">
										<label class="form-label" for="form2Example11">Username:</label>
										<input type="text" name="username" class="form-control">
									</div>
									<div class="form-outline mb-4">
										<label class="form-label" for="form2Example11">Password:</label>
										<input type="password" name="password" class="form-control">
									</div>
									<div class="d-flex align-items-center justify-content-center pb-4">
										<input type="submit" name="action" value="Login" class="form-control btn btn-dark">
									</div>
									<label>Don't already have an Account?</label>
									<a href="/User/register">Register</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- </section> -->

<?php $this->view('shared/footer'); ?>