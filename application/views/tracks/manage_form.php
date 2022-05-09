<?php echo form_open_multipart($form_url, array('id'=>'bb_ajax_form', 'class'=>'form-horizotal')); ?>
<div class="ro">
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
    <?php } elseif ($param2 == 'view') { ?>
        <table id="dtable" class="table table-hover mb-0" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <th>Track Name</th>
                    <th><?php if(!empty($e_name)){echo $e_name; } ?></th>
                </tr>
                <tr>
                    <th>Artist</th>
                    <th><?php if(!empty($e_artist)){echo $e_artist; } ?></th>
                </tr>
                <tr>
                    <th>Genre</th>
                    <th><?php if(!empty($e_genre)){echo $e_genre; } ?></th>
                </tr>
                <tr>
                    <th>Album Status</th>
                    <th><?php if(!empty($e_album_status)){echo $e_album_status; } ?></th>
                </tr>
                <tr>
                    <th>Album Name</th>
                    <th><?php if(!empty($e_album)){echo $e_album; } ?></th>
                </tr>
                <tr>
                    <th>Track</th>
                    <th><audio controls><source src="<?php echo base_url($e_track); ?>" type="audio/mpeg">Your browser does not support the audio element.</audio></th>
                </tr>
                <tr>
                    <th>Track Id</th>
                    <th><?php if(!empty($e_track_id)){echo $e_track_id; } ?></th>
                </tr>
                <tr>
                    <th>Description</th>
                    <th><?php if(!empty($e_description)){echo $e_description; } ?></th>
                </tr>
                <tr>
                    <th>Date Uploaded</th>
                    <th><?php if(!empty($e_date)){echo $e_date; } ?></th>
                </tr>
            </thead>
        </table>
    <?php } else { // insert/edit view ?>
		<input type="hidden" name="id" value="<?php if(!empty($e_id)){echo $e_id;} ?>" />
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label mb-10">Track Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php if(!empty($e_name)){echo $e_name; } ?>" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label mb-10">Artist</label>
                    <select class="form-control select2" name="artist" id="artist" required>
                        <option value="">Select</option>
                        <?php $res = $this->Crud->read_order('artist', 'name', 'asc');
                            foreach ($res as $key) { ?>
                            <option value="<?php echo $key->name; ?>"  <?php if(!empty($e_artist)){if($e_artist == $key->name){echo 'selected';}} ?>><?php echo strtoupper($key->name); ?></option>
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
                            <option value="<?php echo $key->name; ?>" <?php if(!empty($e_genre)){if($e_genre == $key->name){echo 'selected';}} ?>><?php echo strtoupper($key->name); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label mb-10">Album Status</label>
                    <select class="form-control select2" name="status" id="status" tabindex="1" required >
                        <option value="">--Select Status</option>
                        <option value="Album" <?php if(!empty($e_album_status)){if($e_album_status =='Album'){echo 'selected';}} ?>>Album</option>
                        <option value="Stand Alone" <?php if(!empty($e_album_status)){if($e_album_status == 'Stand Alone'){echo 'selected';}} ?>>Stand Alone</option>
                        
                    </select>
                </div>
            </div>

            <?php if (!empty($e_album_status)) { ?>
                <?php if ($e_album_status == 'Stand Alone') {?>
                    <div class="col-md-6" hidden id="alb">
                        <div class="form-group">
                            <label class="control-label mb-10">Album</label>
                            <select class="form-control select2" name="album" id="album">
                                <option value="">--Select Category</option>
                                <?php $res = $this->Crud->read_order('album', 'title', 'asc');
                                    foreach ($res as $key) { ?>
                                    <option value="<?php echo $key->title; ?>" <?php if(!empty($e_album)){if($e_album == $key->name){echo 'selected';}} ?>><?php echo strtoupper($key->title); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } else{?>
                    <div class="col-md-6" id="alb">
                        <div class="form-group">
                            <label class="control-label mb-10">Album</label>
                            <select class="form-control select2" name="album" id="album">
                                <option value="">--Select Category</option>
                                <?php $res = $this->Crud->read_order('album', 'title', 'asc');
                                    foreach ($res as $key) { ?>
                                    <option value="<?php echo $key->title; ?>" <?php if(!empty($e_album)){if($e_album == $key->name){echo 'selected';}} ?>><?php echo strtoupper($key->title); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-6" hidden id="alb">
                    <div class="form-group">
                        <label class="control-label mb-10">Album</label>
                        <select class="form-control select2" name="album" id="album">
                            <option value="">--Select Category</option>
                            <?php $res = $this->Crud->read_order('album', 'title', 'asc');
                                foreach ($res as $key) { ?>
                                <option value="<?php echo $key->title; ?>" <?php if(!empty($e_album)){if($e_album == $key->name){echo 'selected';}} ?>><?php echo strtoupper($key->title); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label mb-10">Track (Mp3)</label>
                    <input type="file" name="music" id="music" accept=".mp3,audio/*" value="<?php if(!empty($e_track)){echo $e_track; } ?>"  required class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label mb-10">Description</label>
                    <textarea class="form-control" id="description" name="description" required rows="4"><?php if(!empty($e_description)){echo $e_description; } ?></textarea>
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