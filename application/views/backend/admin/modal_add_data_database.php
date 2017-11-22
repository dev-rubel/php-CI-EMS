<?php $table_att = $this->db->field_data($param2); 
?>

<div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-heading">
                    <div class="panel-title" >
                        <i class="entypo-plus-circled"></i>
                        <?php echo get_phrase('add_data_to '.ucfirst($param2)); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?admin/add_data_to_database/'.$param2, array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>

                    <?php foreach($table_att as $each): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase($each->name); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="<?php echo $each->name ?>" />
                        </div>
                    </div>
                	<?php endforeach; ?>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_data'); ?></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>