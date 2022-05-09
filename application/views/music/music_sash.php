<div class="panel-body">
	<?php $res = $this->Crud-> read_like4('name', $search, 'artist', $search, 'album', $search, 'description', $search, 'track') ;
	if (empty($res)) {
		echo $this->Crud->msg('danger', 'No Record');
	} else{
		foreach ($res as $key) { ?>
	
	<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
		<div class="panel panel-primary contact-card card-view">
			<div class="panel-heading">
				<div class="pull-left">
					<div class="pull-left user-img-wrap mr-10">
						<img class="card-user-img img-circle pull-left" src="<?php echo base_url(); ?>/assets/img/user2.png" alt="user"/>
					</div>
					<div class="pull-left user-detail-wrap">	
						<span class="block card-user-name">
							<?php echo strtoupper($key->name); ?>
						</span>
						<span class="block card-user-desn">
							<?php echo strtoupper($key->artist); ?>
						</span>
					</div>
				</div>
				<div class="pull-right">
					<a class="pull-left inline-block mr-15" href="<?php echo base_url(); ?>music/viewer/<?php echo $key->track_id; ?>">
						<i class="zmdi zmdi-eye txt-light"></i>
					</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-wrapper collapse in">
				<div class="panel-body row">
					<div class="user-others-details pl-15 pr-15">
						<div class="mb-15">
							<i class="zmdi zmdi-emal-open inline-block mr-10">Genre </i>
							<span class="inline-block txt-dark"><?php echo $key->genre; ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } }?>	
</div>