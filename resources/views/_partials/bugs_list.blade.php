<div class="row">
				<div class="col-xs-12">


					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<div class="table-header">
						Bugs Registered
					</div>

					<!-- div.table-responsive -->

					<!-- div.dataTables_borderWrap -->
					<div>
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
								<th>No</th>
								<th>Name</th>
								<th>Penyelesaian</th>
                                <th>Application</th>
								<th>Modul</th>

								<th>Pilih</th>
							</tr>
							</thead>

							<tbody>
							<?php $no=1;?>
							@foreach($bugs as $data)
							<tr>
								<td class="center">
									{{ $no }}
								</td>

								<td>
									{{ $data['nama_bugs'] }}
								</td>
								<td>
									{{ $data['penyelesaian'] }}
								</td>
                                <td>
                                    {{ $data->software_detail->software->nama }}
                                </td>
                                <td>
                                    {{ $data->software_detail->nama_modul }}
                                </td>




								<td>
									<input type="checkbox" data-id="{{ $data->id_bugs }}" data-name="{{ $data->nama_bugs }}" data-penyelesaian="{{ $data->penyelesaian }}" data-software="{{ $data->software_detail->software->nama }}" data-modul="{{ $data->software_detail->nama_modul }}" onclick="pilih(this);" >
								</td>
							</tr>
							<?php $no++;?>
							@endforeach

							</tbody>
						</table>
						<br />
						
					</div>
					
				</div>
			</div>
<script src="{{ asset('assets/js/dataTables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/js/dataTables/jquery.dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/dataTables/extensions/TableTools/js/dataTables.tableTools.js') }}"></script>
<script src="{{ asset('assets/js/dataTables/extensions/ColVis/js/dataTables.colVis.js') }}"></script>
			<script type="text/javascript">
				function PopupCenter(url, title, w, h) {
				    // Fixes dual-screen position                         Most browsers      Firefox
				    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
				    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

				    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
				    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

				    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
				    var top = ((height / 2) - (h / 2)) + dualScreenTop;
				    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

				    // Puts focus on the newWindow
				    if (window.focus) {
				        newWindow.focus();
				    }
				}

				function pilih(elm){
					var _id = $(elm).data("id");
					var _name = $(elm).data("name");
					var _solusi = $(elm).data("penyelesaian");
					var _software = $(elm).data("software");
					var _modul = $(elm).data("modul");

					$('#bugs').append("<tr><td>"+_name+"</td><td>"+_solusi+"</td><td>"+_software+"</td><td>"+_modul+"</td><td><a style='cursor:pointer' onclick='delete_row(this);'>Hapus</a></td><input type='hidden' name='bugs[]' value='"+_id+"' id='bugs_add'></tr>");
				}

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

		//initiate TableTools extension
		var tableTools_obj = new $.fn.dataTable.TableTools( oTable1, {
			
			"sSelectedClass": "success",
			
		} );
		//we put a container before our table and append TableTools element to it

		//also add tooltips to table tools buttons
		//addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
		//so we add tooltips to the "DIV" child after it becomes inserted
		//flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
		


		//ColVis extension
		var colvis = new $.fn.dataTable.ColVis( oTable1, {
			
			

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



		/////////////////////////////////
		//table checkboxes
		$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

		//select/deselect all rows according to table header checkbox
		$('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header

			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) tableTools_obj.fnSelect(row);
				else tableTools_obj.fnDeselect(row);
			});
		});

		//select/deselect a row when the checkbox is checked/unchecked
		$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(!this.checked) tableTools_obj.fnSelect(row);
			else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
		});




		$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
			e.stopImmediatePropagation();
			e.stopPropagation();
			e.preventDefault();
		});


		//And for the first simple table, which doesn't have TableTools or dataTables
		//select/deselect all rows according to table header checkbox
		var active_class = 'active';
		$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header

			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
			});
		});

		//select/deselect a row when the checkbox is checked/unchecked
		$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
			var $row = $(this).closest('tr');
			if(this.checked) $row.addClass(active_class);
			else $row.removeClass(active_class);
		});



		/********************************/
		//add tooltip for small view action buttons in dropdown menu
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

		//tooltip placement on right or left
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();
			
			var off2 = $source.offset();
			//var w2 = $source.width();
			
			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}

	})
</script>