<!-- Title -->
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark"></h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
		<li class="active"><span>Genre</span></li>
	  </ol>
	</div>
	<!-- /Breadcrumb -->
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">Manage Genre</h6>
					
				</div>
				<div class="pull-right">
					<button class="btn btn-info btn-anim btn-square pop text-info" href="javascript:;" pageTitle="Manage" pageName="<?php echo base_url('genre/index/manage'); ?>" pageSize="modal-sm" data-toggle="tooltip" title="ADD"><i class="icon-plus"></i><span class="btn-text">NEW</span></button>
				</div><div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body">
					<div class="table-wrap">
						<div class="table-responsive">
							<table id="dtable" class="table table-hover mb-0" >
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th width="150px">Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- /Row -->
