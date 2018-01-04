<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('account_list'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_account'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
                <div id="editBankACHolder"></div>
                    <div id="BankACList">
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Account Name</th>
                            <th>Account No.</th>
                            <th>Account Description</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $count = 0;
                        if(!empty($accounts)):
                        foreach($accounts as $each): ?>
                                <tr>
                                <th scope="row"><?php echo $count++; ?></th>
                                <td><?php echo $each['acc_name'] ?></td>
                                <td><?php echo $each['acc_no'] ?></td>
                                <td><?php echo $each['acc_details'] ?></td>
                                <td>
                                    <a href="#" class="btn btn-xs btn-primary" onclick="editBankAC('<?php echo $each['acc_id'];?>')">Edit</a>
                                    
                                    <a href="#" class="btn btn-xs btn-danger" onclick="confirm_modal('<?php echo base_url().'index.php?a/accounting/delete_bank_account/'.$each['acc_id']; ?>')">Delete</a>
                                </td>
                                </tr>
                            <?php endforeach;
                            else:
                            echo '<tr class="text-center">';
                            echo '<td colspan="5">No Account Found</td>';
                            echo '</tr>';
                            endif;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                  
                  <form id="createBankAC" action="<?php echo base_url() .'index.php?admin/ajax_add_bank_account'; ?>" class="form-horizontal form-groups-bordered" method="post">

                      <div class="col-md-offset-3 col-md-4">
                            <h3 class="text-right">Add Account Details</h3>

                          <div class="form-group">
                              <input type="text" class="form-control" name="acc_name" placeholder="Bank Account Name" required="required">
                          </div>
                          <div class="form-group">
                              <input type="number" class="form-control" name="acc_no" placeholder="Bank Account No." required="required">
                          </div>
                          <div class="form-group">
                              <input type="text" class="form-control" name="acc_details" placeholder="Bank Account Details">
                          </div>
                          <div class="form-group">
                              <button class="btn btn-info" type="submit">Save</button>
                          </div>
                          
                      </div>
                  </form>
            </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {

        $('#createBankAC').ajaxForm({
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
                    $("#BankACList").html(jData.html);
                    $("#table_export").dataTable();
                    $('#createBankAC').resetForm();
                }
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });




    });

    function editBankAC(BankACID) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url();?>index.php?admin/ajax_edit_bank_ac/' + BankACID,
            beforeSend: function () {
                $('#loading2').show();
                $('#overlayDiv').show();
            },
            success: function (data) {
                var jData = JSON.parse(data);

                toastr.success(jData.msg);
                $("#editBankACHolder").html(jData.html);
                $('body,html').animate({
                    scrollTop: 350
                }, 800);
                $('#loading2').fadeOut('slow');
                $('#overlayDiv').fadeOut('slow');
            }
        });
    }
</script>

