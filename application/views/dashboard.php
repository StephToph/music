<!-- Row -->
<div class="row">
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="txt-dark block counter"><span class="counter-anim"><?php echo is_countable($this->Crud->read('track')) ? count($this->Crud->read('track')) : 0;?></span></span>
									<span class="weight-500 uppercase-font block font-13">Tracks statistics</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="icon-user-following data-right-rep-icon txt-grey"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="txt-dark block counter"><span class="counter-anim"><?php echo is_countable($this->Crud->read('album')) ? count($this->Crud->read('album')) : 0; ?></span></span>
									<span class="weight-500 uppercase-font block">Album statistics</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="icon-control-rewind data-right-rep-icon txt-grey"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-default card-view pa-0">
			<div class="panel-wrapper collapse in">
				<div class="panel-body pa-0">
					<div class="sm-data-box">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
									<span class="txt-dark block counter"><span class="counter-anim"><?php echo is_countable($this->Crud->read('artist')) ? count($this->Crud->read('artist')) : 0;?></span></span>
									<span class="weight-500 uppercase-font block">artist statistics</span>
								</div>
								<div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
									<i class="icon-layers data-right-rep-icon txt-grey"></i>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /Row -->
</div>
<!-- Footer -->
		<footer class="footer container-fluid pl-30 pr-30">
			<div class="row">
				<div class="col-sm-12">
					<p><?php echo date('Y'); ?> &copy; EC. Developed by Tee-Fingerz</p>
				</div>
			</div>
		</footer>
		<!-- /Footer -->
		
	</div>
    <!-- /Main Content -->

</div>
    <!-- /#wrapper -->
	<div class="modal fade" id="modal_pop" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h5 class="modal-title"> </h5>
				</div>
				<div class="modal-body"> </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>assets/vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Data table JavaScript -->
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	
	<!-- Fancy Dropdown JS -->
	<script src="<?php echo base_url(); ?>assets/dist/js/dropdown-bootstrap-extended.js"></script>
	<script src="<?php echo base_url(); ?>assets/dist/js/jquery.slimscroll.js"></script>
	
	<!-- Toast JavaScript -->
	<script src="<?php echo base_url(); ?>assets/vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/dist/js/init.js"></script>
	<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
	
	<?php if(!empty($table_rec)){ ?>
		<script type="text/javascript">
			
			$(document).ready(function() {
				//datatables
				var table = $('#dtable').DataTable({ 
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"order": [[<?php if(!empty($order_sort)){echo $order_sort;} ?>]], //Initial order.
					"language": {
						"processing": "<i class='fa fa-spinner fa-2x fa-spin' aria-hidden='true'></i> Processing... please wait"
					},
					"pagingType": "full",
			
					// Load data for the table's content from an Ajax source
					"ajax": {
						url: "<?php echo base_url($table_rec); ?>",
						type: "POST"
					},
					
					//Set column definition initialisation properties.
					"columnDefs": [
						{ 
							"targets": [<?php if(!empty($no_sort)){echo $no_sort;} ?>], //columns not sortable
							"orderable": false, //set not orderable
						},
					],
			
				});
			});
		</script>
	<?php } ?>
</body>

</html>
