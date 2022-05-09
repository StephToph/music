<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horizontal')); ?>
<div class="row">
    <div id="bb_ajax_msg"></div>
    
    <?php if($param2 == 'delete') { // delete view ?>
        <div class="col-xs-12 text-center">
            <h3><b>Are you sure</b></h3>
            <input type="hidden" name="d_id" value="<?php if(!empty($d_id)){echo $d_id;} ?>" />
        </div>
        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-danger text-uppercase" type="submit">
                    <span class="btn-label"><i class="fa fa-trash-o"></i></span> Yes - Delete
                </button>
            </div>
        </div>
    <?php } else { // insert/edit view ?>
		<input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
					<label for="name">Name</label><br>
					<input class="form-control" type="text" id="name" name="name" value="<?php if(!empty($e_name)){echo $e_name;} ?>" required>
                </div>
            </div>
        </div>

       
        <div class="col-sm-12 text-center">
			<button class="btn btn-success btn-sm text-uppercase" type="submit">
				<span class="btn-label"><i class="fa fa-save"></i></span> Save
			</button>
        </div>
    <?php } ?>
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url(); ?>assets/jsform.js"></script>
