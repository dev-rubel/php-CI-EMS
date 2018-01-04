<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab">
                    <i class="entypo-menu"></i>
                    <?php echo get_phrase('shift_list'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab">
                    <i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_shift'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">

                <div id="editShiftHolder"></div>
                <div id="shiftList">

                    <table class="table table-bordered datatable" id="table_export">
                        <thead>
                            <tr>
                                <th>
                                    <div>#</div>
                                </th>
                                <th>
                                    <div>
                                        <?php echo get_phrase('shift_name'); ?>
                                    </div>
                                </th>
                                <th>
                                    <div>
                                        <?php echo get_phrase('options'); ?>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1;
                        foreach ($shifts as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $count++; ?>
                                </td>
                                <td>
                                    <?php echo $row['name']; ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                            Action
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                            <!-- EDITING LINK -->
                                            <li>
                                                <a href="#" onclick="editShift('<?php echo $row['shift_id'];?>')">
                                                    <i class="entypo-pencil"></i>
                                                    <?php echo get_phrase('edit'); ?>
                                                </a>
                                            </li>
                                            <li class="divider"></li>

                                            <!-- DELETION LINK -->
                                            <li>
                                                <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/shifts/delete/<?php echo $row['shift_id']; ?>');">
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
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">

                    <form id="createShift" action="<?php echo base_url() .'index.php?admin/ajax_create_shift'; ?>" class="form-horizontal form-groups-bordered" method="post">

                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">
                                    <?php echo get_phrase('name'); ?>
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info">
                                    <?php echo get_phrase('add_shift'); ?>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
            <!----CREATION FORM ENDS-->
        </div>

    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {

        $('#createShift').ajaxForm({
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);

                if (!jData.type) {
                    toastr.error(jData.msg);
                } else {
                    toastr.success(jData.msg);
                    $("#shiftList").html(jData.html);
                    $("#table_export").dataTable();
                    $('#createShift').resetForm();
                }
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });




    });

    function editShift(shiftID) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?admin/ajax_edit_shift/' + shiftID,
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);

                toastr.success(jData.msg);
                $("#editShiftHolder").html(jData.html);
                $('body,html').animate({
                    scrollTop: 350
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }
</script>