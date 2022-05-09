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

        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="business_name">Description</label><br>    
                    <textarea name="description" id="description" required class="form-control"><?php if(!empty($e_description)){echo $e_description;} ?></textarea>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-xs-12">
                    <label for="business_name">Profile Picture</label><br>
                    <?php 
                        if (!empty($e_img_id)) {
                            $image = $e_img_id;
                        } else {
                            $image = 'assets/avatar.png';
                        }

                    ?>   
                    <img src="<?php echo base_url($image); ?>" class="d-flex img-circle" height="100px" width="100px" id="output">
                    <input type="file" class="form-control" name="pics" id="pics" onchange="loadFile(event)">
                    <span class="help-block"> Enter your Image. </span> 
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
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>