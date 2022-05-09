
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark">add Track</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
		<li class="active"><span>add Track</span></li>
	  </ol>
	</div>
	<!-- /Breadcrumb -->
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="form-wrap">
						<?php echo form_open_multipart('tracks/add', array('id'=>'bb_ajax_form', 'class'=>'form-horizonal')); ?>
							<div id="bb_ajax_msg"></div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Track Name</label>
										<input type="text" id="name" name="name" class="form-control" placeholder="Rounded Chair" required>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Artist</label>
										<select class="form-control select2" name="artist" id="artist" required>
											<option value="">Select</option>
											<?php $res = $this->Crud->read_order('artist', 'name', 'asc');
											    foreach ($res as $key) { ?>
												<option value="<?php echo $key->name; ?>"><?php echo strtoupper($key->name); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Genre</label>
										<select class="form-control select2" name="genre" id="genre" required>
											<option value="">Select</option>
											<?php $res = $this->Crud->read_order('genre', 'name', 'asc');
											    foreach ($res as $key) { ?>
												<option value="<?php echo $key->name; ?>"><?php echo strtoupper($key->name); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Album Status</label>
										<select class="form-control select2" name="status" id="status" tabindex="1" required >
											<option value="">--Select Status</option>
											<option value="Album">Album</option>
											<option value="Stand Alone">Stand Alone</option>
											
										</select>
									</div>
								</div>

								<div class="col-md-6" hidden id="alb">
									<div class="form-group">
										<label class="control-label mb-10">Album</label>
										<select class="form-control select2" name="album" id="album">
											<option value="">--Select Category</option>
											<?php $res = $this->Crud->read_order('album', 'title', 'asc');
											    foreach ($res as $key) { ?>
												<option value="<?php echo $key->title; ?>"><?php echo strtoupper($key->title); ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Track (Mp3)</label>
										<input type="file" name="music" id="music"  required class="form-control">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label mb-10">Description</label>
										<textarea class="form-control" id="description" name="description" required rows="4"></textarea>
									</div>
								</div>


							</div>
							
							<div class="form-actions">
								<button class="btn btn-success btn-block btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>save</span></button>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

		 <footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p><?php echo date('Y'); ?> &copy; <?php echo app_name; ?>.</p>
					</div>
				</div>
			</footer>
		</div>
		<script src="<?php echo base_url(); ?>assets/plugin/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	 <script src="<?php echo base_url(); ?>assets/plugin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	 <script src="<?php echo base_url(); ?>assets/plugin/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	 <script src="<?php echo base_url(); ?>assets/plugin/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	 <script src="<?php echo base_url(); ?>assets/js/dropdown-bootstrap-extended.js"></script>
	
	 <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
	 <script src="<?php echo base_url(); ?>assets/js/init.js"></script>
	 <script src="<?php echo base_url(); ?>assets/jsform.js"></script>

<script>

	$(function () {
     $('#alb').hide(); // this line you can avoid by adding #row_dim{display:none;} in your CSS
     $('#status').change(function () {
         $('#alb').hide();
         if (this.options[this.selectedIndex].value == 'Album') {
             $('#alb').show();
         }
     });
 });
	

	var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
        
	<!-- JavaScripts -->
	</body>
</html>