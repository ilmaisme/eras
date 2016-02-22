@extends("template.master")
@section("title","Software List")
@section("breadcrumbs",Breadcrumbs::render('software'))
@section("sidebar_menu")
	@include("menu.support_menu")
@endsection
@section("content")
	<div class="page-content">
						
						
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Software
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Software List
								</small>
							</h1>

						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-xs-12">
							@if(Session::has('error'))
											    {!!  CustomLib::generate_notification(Session::get('error'),"error") !!}
										@endif

										@if(Session::has('success'))
											    {!!  CustomLib::generate_notification(Session::get('success'),"success") !!}
										@endif

														
										
								<div class="row">
									<div class="col-xs-12">
										

										<div class="clearfix">
											<div class="pull-right tableTools-container"></div>
										</div>
										<div class="table-header">
											Software Registered
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>No</th>
														<th>Name</th>
														<th>Version</th>
														

														<th></th>
													</tr>
												</thead>

												<tbody>
												<?php $no=1;?>
												@foreach($software as $data)
													<tr>
														<td class="center">
															{{ $no }}
														</td>

														<td>
															{{ $data['nama'] }}
														</td>
														<td>
															{{ $data['versi'] }}
														</td>
												
														

														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="blue" href="{{ url('software/show',$data['id_software']) }}">
																	<i class="ace-icon fa fa-search-plus bigger-130"></i>
																</a>

																<a class="green" href="{{ url('software/edit',$data['id_software']) }}">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a href="{{ route('software.delete',array($data['id_software'])) }}" data-method="delete" rel="nofollow"  data-token={{ csrf_token() }} class="red" id="delete_software"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>

															</div>
															
														</td>
													</tr>
													<?php $no++;?>
												@endforeach
													
												</tbody>
											</table>
										</div>
										<br />

										<a href="{{ url('software/create') }}">
											<button class="btn btn-app btn-pink btn-sm">
												<i class="ace-icon glyphicon glyphicon-pencil"></i>
												Add
											</button>
										</a>		
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
@endsection
@section("js_script")
	<script src="{{ asset('assets/js/dataTables/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables/jquery.dataTables.bootstrap.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}"></script>
	<script src="{{ asset('assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}"></script>
	<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var oTable1 = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.dataTable( {
					bAutoWidth: false,
					
					"aaSorting": [],
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					//"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			    } );
				//oTable1.fnAdjustColumnSizing();
			
			
				//TableTools settings
				TableTools.classes.container = "btn-group btn-overlap";
				TableTools.classes.print = {
					"body": "DTTT_Print",
					"info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
					"message": "tableTools-print-navbar"
				}
			
				//initiate TableTools extension
				var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
					"sSwfPath": "../assets/js/dataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf", //in Ace demo ../assets will be replaced by correct assets path
					
					"sRowSelector": "td:not(:last-child)",
					"sRowSelect": "multi",
					"fnRowSelected": function(row) {
						//check checkbox when row is selected
						try { $(row).find('input[type=checkbox]').get(0).checked = true }
						catch(e) {}
					},
					"fnRowDeselected": function(row) {
						//uncheck checkbox
						try { $(row).find('input[type=checkbox]').get(0).checked = false }
						catch(e) {}
					},
			
					"sSelectedClass": "success",
			        "aButtons": [
						{
							"sExtends": "copy",
							"sToolTip": "Copy to clipboard",
							"sButtonClass": "btn btn-white btn-primary btn-bold",
							"sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
							"fnComplete": function() {
								this.fnInfo( '<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied '+(oTable1.fnSettings().fnRecordsTotal())+' row(s) to the clipboard.</p>',
									1500
								);
							}
						},
						
						{
							"sExtends": "csv",
							"sToolTip": "Export to CSV",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
						},
						
						{
							"sExtends": "pdf",
							"sToolTip": "Export to PDF",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
						},
						
						{
							"sExtends": "print",
							"sToolTip": "Print view",
							"sButtonClass": "btn btn-white btn-primary  btn-bold",
							"sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",
							
							"sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",
							
							"sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Press <b>escape</b> when finished.</p>",
						}
			        ]
			    } );
				//we put a container before our table and append TableTools element to it
			    $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));
				
				//also add tooltips to table tools buttons
				//addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
				//so we add tooltips to the "DIV" child after it becomes inserted
				//flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
				setTimeout(function() {
					$(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
						var div = $(this).find('> div');
						if(div.length > 0) div.tooltip({container: 'body'});
						else $(this).tooltip({container: 'body'});
					});
				}, 200);
				
				
				
				//ColVis extension
				var colvis = new $.fn.dataTable.ColVis( oTable1, {
					"buttonText": "<i class='fa fa-search'></i>",
					"aiExclude": [0, 6],
					"bShowAll": true,
					//"bRestore": true,
					"sAlign": "right",
					"fnLabel": function(i, title, th) {
						return $(th).text();//remove icons, etc
					}
					
				}); 
				
				//style it
				$(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')
				
				//and append it to our table tools btn-group, also add tooltip
				$(colvis.button())
				.prependTo('.tableTools-container .btn-group')
				.attr('title', 'Show/hide columns').tooltip({container: 'body'});
				
				//and make the list, buttons and checkboxed Ace-like
				$(colvis.dom.collection)
				.addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
				.find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
				.find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');
			
			
			
			})
		</script>

		<script>
			
			$(document).on('click', 'a#delete_software', function(e) {
				e.preventDefault();
				var conf = confirm("Delete This Data ? ");
				if(conf){
					var token = $(this).data('token');
					var route = $(this).attr('href');

				    $.ajax({
				        url:route,
				        type: 'post',
				        data: {_method: 'delete', _token :token}
				    }).done(function(){
				    	location.reload(true);
				    });
				}
				
			   
			});
		</script>
@endsection