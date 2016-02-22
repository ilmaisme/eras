@extends("template.master")
@section("title","Dashboard Support")
@section("sidebar_menu")
	@include("menu.support_menu")
@endsection
@section("content")
	<div class="page-content">
						<!-- #section:settings.box -->
						

						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								

								<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-12 infobox-container">
										<!-- #section:pages/dashboard.infobox -->
										<div class="infobox infobox-green">
											

											<div class="infobox-data">
												<span class="infobox-data-number">Ticket</span>
												
											</div>

										</div>

										<div class="infobox infobox-blue">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $tiket_open }}</span>
												<div class="infobox-content">Open</div>
											</div>

											
										</div>

										<div class="infobox infobox-pink">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $tiket_process }}</span>
												<div class="infobox-content">Process</div>
											</div>
											
										</div>

										<div class="infobox infobox-red">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $tiket_finish }}</span>
												<div class="infobox-content">Finish</div>
											</div>
										</div>

										<div class="infobox infobox-orange2">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											

											<!-- /section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-data">
												<span class="infobox-data-number">{{ $tiket_cancel }}</span>
												<div class="infobox-content">Cancelled</div>
											</div>

											
										</div>

										<div class="infobox infobox-green">
											

											<div class="infobox-data">
												<span class="infobox-data-number">Renc. Kunjungan</span>
												
											</div>

										</div>

										<div class="infobox infobox-blue">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $rk_waiting }}</span>
												<div class="infobox-content">Waiting for Approved</div>
											</div>

											
										</div>

										<div class="infobox infobox-pink">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $rk_approved }}</span>
												<div class="infobox-content">Approved</div>
											</div>
											
										</div>

										<div class="infobox infobox-red">
											

											
										</div>

										<div class="infobox infobox-orange2">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											

											

											
										</div>

										<div class="infobox infobox-green">
											

											<div class="infobox-data">
												<span class="infobox-data-number">Server Maintenance</span>
												
											</div>

										</div>

										<div class="infobox infobox-blue">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $sm_waiting }}</span>
												<div class="infobox-content">Waiting for Approved</div>
											</div>

											
										</div>

										<div class="infobox infobox-pink">
											

											<div class="infobox-data">
												<span class="infobox-data-number">{{ $sm_approved }}</span>
												<div class="infobox-content">Approved</div>
											</div>
											
										</div>

										<div class="infobox infobox-red">
											

											
										</div>

										<div class="infobox infobox-orange2">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											

											

											
										</div>

										<!-- /section:pages/dashboard.infobox -->
										<div class="space-6"></div>

										<!-- #section:pages/dashboard.infobox.dark -->
										
										<!-- /section:pages/dashboard.infobox.dark -->
									</div>

									<div class="vspace-12-sm"></div>

									
								</div><!-- /.row -->

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
@endsection