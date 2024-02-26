@include('layouts.app')
@include('layouts.nav')

<section id="content">

<div class="content-wrap bg-light">

	<div class="container">

		<div class="row justify-content-center">
			<div class="col-lg-7 col-md-10">
				<div class="card shadow-sm">
					<div class="card-header">
						<h4 class="mb-0 center">Financial Membership Form</h4>
					</div>
					<div class="card-body">

						<div class="form-widget">

							<div class="form-result"></div>

							<div class="form-process">
								<div class="css3-spinner">
									<div class="css3-spinner-double-bounce1"></div>
									<div class="css3-spinner-double-bounce2"></div>
								</div>
							</div>

							<form class="mb-0" id="eligible_name" name="eligible_name" action="include/form.php" method="post" enctype="multipart/form-data">

								<div class="row">

									<div class="col-12 bottommargin-sm">
										<label for="eligible_name">Name<small class="text-danger">*</small></label>
										<input type="text" id="eligible_name" name="eligible_name" value="" class="form-control required" placeholder="Enter your Full Name" />
									</div>

									<div class="col-12 bottommargin-sm">
										<label for="email">Email Address<small class="text-danger">*</small></label>
										<input type="email" name="email" id="email" class="form-control required" value="" placeholder="abc@gmail.com">
											</div>

									

									<div class="col-12 bottommargin-sm">
										<label for="template-contactform-phone">Phone:</label>
										<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="form-control" placeholder="Enter your phone Number.." />
									</div>

									<div class="col-12 bottommargin-sm">
										<label>Gender:</label>
										<div class="form-check">
											<input class="male" type="radio" id="male" name="gender" value="male">
											<label class="male" for="male">Male</label>
										</div>
										<div class="form-check">
											<input class="female" type="radio" id="female" name="gender" value="female">
											<label class="female" for="female">Female</label>
										</div>
									</div>

									

									<div class="col-12 bottommargin-sm">
										<label for="template-contactform-date">Date of Birth:</label>
										<div class="form-group mb-0">
											<div class="input-group text-start">
												<div class="input-group-text" data-target=".datetimepicker1" data-toggle="datetimepicker"><i class="icon-calendar3"></i></div>
												<input id="template-contactform-date" name="template-contactform-date" type="text" class="form-control datetimepicker-input datetimepicker1" data-target=".datetimepicker1" data-toggle="datetimepicker" placeholder="DD/MM/YY" />
											</div>
										</div>
									</div>


									<div class="col-12 bottommargin-sm">
										<label for="age" class="mb-3 clearfix">Your Age:</label>
										<input id="age" name="age" class="range_01 input-range-slider" />
									</div>

					

									<div class="col-12 bottommargin-sm">
										<h5>MONTHLY DUES:</h5>
										<label><p>To support the work of the ministry, monthly dues for Financial Partners are N10,000 and above. Do you 
								pledge to give your faithful support for the continuity of the work of the ministry
								</p></label>
										<div class="form-check">
											<input class="yes" type="radio" id="yes" name="monthly_dues" value="yes">
											<label class="yes" for="yes">YES</label>
										</div>
										<div class="form-check">
											<input class="no" type="radio" id="no" name="monthly_dues" value="no">
											<label class="no" for="no">NO</label>
										</div>
									</div>

									<h5>BANKS - For Dues: </h5><br>
<h4><p>You can pay:<br>
ALIVE-NG <br>
GT Bank Account No: 0239650736</p></h4>
<h4>DECLARATION </h4> <br>
<p>By clicking the submit button, I declare that if recognized as a member, I will be committed to the duties to 
which I am assigned. I will be of good behavior and abide by the rules of ALIVE Nigeria</p>


									<div class="col-12 d-none">
										<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" />
									</div>
									<div class="col-12">
										<button type="submit" name="template-contactform-submit" class="btn btn-success w-100 btn-lg">Send</button>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</div>

							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div style="float:left">
			<a href="{{url('eligibility')}}" class="btn btn-success topmargin-lg"><-Previous</a>
			</div>
	</div>
</div>
</section><!-- #content end -->