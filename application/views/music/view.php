<div class="row heading-bg">
	<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
		<h5 class="txt-dark">Music</h5>
	</div>
	<!-- Breadcrumb -->
	<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
			<li class="active"><span>music</span></li>
		</ol>
	</div>
	<!-- /Breadcrumb -->
</div>
<!-- /Title -->

<!-- Row -->
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
			<div class="refresh-container">
				<div class="la-anim-1"></div>
			</div>
			<div class="panel-heading">
				<div class="pull-left">
					<h6 class="panel-title txt-dark">
						<select class="form-control" name="genre" id="genre" onchange="gen();">
							<option value="">--Select Genre--</option>	
							<?php $ret = $this->Crud->read('genre'); 
							foreach ($ret as $key) { ?>
								<option value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
							<?php } ?>
						</select>
					</h6>
				</div>
				<div class="pull-right">
					<form role="search" class="inbox-search inline-block pull-left mr-15">
						<div class="input-group">
							<input name="sash" id="sash" class="form-control" placeholder="Search Music" type="text">
							<span class="input-group-btn">
							<button type="button" class="btn  btn-default" data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true" onclick="search_music();"><i class="zmdi zmdi-search"></i></button>
							</span>
						</div>
					</form>
				</div>
				<div class="clearfix"></div>
			</div>

			<div class="panel-wrapper collapse in" id="track_result">
                <div class="panel-body">
                	<?php $res = $this->Crud->read('track');
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
					<?php }} ?>	
				</div>
			</div>
        </div>
	</div>
</div>
<script>
		    
    function gen() {
        var genre = $('#genre').val();
        $('#track_result').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
        $.ajax({
            url: '<?php echo base_url('music/search/'); ?>'+ genre,
            success: function(data) {
                $('#track_result').html(data);
            }
        });
    }

    function search_music() {
        var sash = $('#sash').val();
        $('#track_result').html('<div class="text-center col-lg-12"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> please wait...</div>');
        $.ajax({
            url: '<?php echo base_url('music/sash/'); ?>'+ sash,
            success: function(data) {
                $('#track_result').html(data);
            }
        });
    }

</script>