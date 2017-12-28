<hr />
<?php
//pd($classes);
?>
<div class="row">
    <div class="col-md-12">

        <!------ CONTROL TABS START ------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#grouplist" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('group_list'); ?>
                </a></li>
            <li>
                <a href="#groupadd" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_group'); ?>
                </a></li>
        </ul>
        <!------ CONTROL TABS END ------>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="grouplist">

                <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('group_name'); ?></div></th>
                            <th><div><?php echo get_phrase('class_name'); ?></div></th>
                            <th><div><?php echo get_phrase('options'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($groups as $row): ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo ucwords(str_replace('-', ' ', $row['name'])); ?></td>
                                <td><?php echo $this->db->get_where('class',array('class_id'=>$row['class_id']))->row()->name;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_edit_group/<?php echo $row['group_id']; ?>');">
                                                    <i class="entypo-pencil"></i>
    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/groups/delete/<?php echo $row['group_id']; ?>');">
                                                    <i class="entypo-trash"></i>
    <?php echo get_phrase('delete'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
<?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="groupadd" style="padding: 5px">
                <div class="box-content">
<?php echo form_open(base_url() . 'index.php?admin/groups/create', array('class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top')); ?>
                <div class="padded">
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>
                        <div class="col-sm-5">                            
                            <select name="class_id" class="form-control">
                                <?php if(in_array_r(9, $classes) || in_array_r(91, $classes) || in_array_r(10, $classes)){
                                    foreach($classes as $list){
                                        if(in_array(9, $list) || in_array(91, $list) || in_array(10, $list)){
                                    ?>
                                <option value="<?php echo $list['class_id'];?>"><?php echo $list['name'];?></option>
                                <?php }}}else{?>
                                <option>Group Only work in class 9 or 10.</option>
                                    
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                   
                    <div class="padded">
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('group_name'); ?></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('add_group'); ?></button>
                        </div>
                    </div>
                    </form>                
                </div>                
            </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function ($)
    {


        var datatable = $("#table_export").dataTable();

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });

</script>