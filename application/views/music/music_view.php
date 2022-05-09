<!-- Title -->
<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	  <h5 class="txt-dark">Music View </h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	  <ol class="breadcrumb">
		<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
		<li><a href="#"><span>music</span></a></li>
		<li class="active"><span>view</span></li>
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
					<div class="row">
						<div class="col-md-3">
							<div class="item-big">
								<img src="<?php echo base_url() ?>assets/default.jpg" alt="Second slide image" width="100%" height="100%">
								
							</div>
						</div>
							
						<div class="col-md-9">
							<div class="product-detail-wrap">
								<h3 class="mb-20 weight-500"><?php echo strtoupper($this->Crud->read_field('track_id', $user, 'track', 'name')); ?></h3>
								<div class="product-price head-font mb-30"><?php echo strtoupper($this->Crud->read_field('track_id', $user, 'track', 'artist')); ?></div>
								<p class="mb-50"><?php echo ucwords($this->Crud->read_field('track_id', $user, 'track', 'description')); ?></p>
								
								<audio controls class="form-control"><source src="<?php echo base_url($this->Crud->read_field('track_id', $user, 'track', 'track')); ?>" type="audio/mpeg">Your browser does not support the audio element.</audio>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Row -->

<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div  class="tab-struct custom-tab-1 product-desc-tab">
							<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_7">
								<li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="descri_tab" href="#descri_tab_detail"><span>Additional Information</span></a></li>
								<li role="presentation" class="next"><a  data-toggle="tab" id="adi_info_tab" role="tab" href="#adi_info_tab_detail" aria-expanded="false"><span>QR CODE</span></a></li>
							</ul>
							<div class="tab-content" id="myTabContent_7">
								<div  id="descri_tab_detail" class="tab-pane fade active in pt-0" role="tabpanel">
									<div class="table-wrap">
										<div class="table-responsive">
										  <table class="table  mb-0">
											<tbody>
												<tr>
													<td class="border-none">GENRE</td>
													<td class="border-none"><?php echo strtoupper($this->Crud->read_field('track_id', $user, 'track', 'genre')); ?></td>
												</tr>
												<tr>
													<td>TRACK TYPE</td>
													<td><?php echo strtoupper($this->Crud->read_field('track_id', $user, 'track', 'album_status')); ?></td>
												</tr>
												<?php if ($this->Crud->read_field('track_id', $user, 'track', 'album_status') == 'Album') {?>
													<tr>
														<td>ALBUM</td>
														<td><?php echo strtoupper($this->Crud->read_field('track_id', $user, 'track', 'album')); ?></td>
													</tr>
												<?php } ?>
											</tbody>
										  </table>
										</div>
									</div>
								</div>
								<div  id="adi_info_tab_detail" class="tab-pane pt-0 fade" role="tabpanel">
									<div class="table-wrap">
										<div class="table-responsive">
										  <table class="table  mb-0">
											<tbody>
												<tr>
													<td class="border-none"><img src="<?php echo base_url(); ?>/<?php echo $this->Crud->read_field('track_id', $user, 'track', 'music_qr'); ?>" style="max-width: 240px; max-height: 240px" ></td>
													
												</tr>
											</tbody>
										  </table>
										</div>
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