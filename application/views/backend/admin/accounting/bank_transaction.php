<style>
  .cash-in{
    background-color: #2ECC71;
    color: #fff;
  }
  .cash-out{
    background-color: #E74C3C;
    color: #fff;
  }
  div#currentBalanceHolder {
    border: 1px solid gainsboro;
  }
</style>

<hr />
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#acc_list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('all_accounts_balance'); ?>
                </a></li>
            <li>
            <li>
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('all_transaction'); ?>
                </a></li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_transaction'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>

        <div class="tab-content">
          
            <br>
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="acc_list">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Account Name</th>
                    <th>Account No.</th>
                    <th>Total Cash IN</th>
                    <th>Total Cash OUT</th>
                    <th>Current Balance</th>
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($bank_accounts)): foreach($bank_accounts as $k=>$each): ?>
                  <tr>
                    <td><?php echo $k+1; ?></td>
                    <td><?php echo $each['acc_name']; ?></td>
                    <td><?php echo $each['acc_no']; ?></td>
                    <td>
                      <?php 
                        $this->db->select_sum('tran_amount');
                        $this->db->where('acc_id', $each['acc_id']);
                        $this->db->where('tran_status', 1);
                        $totalCashIN = $this->db->get('bank_transaction')->result_array();
                        echo $totalCashIN[0]['tran_amount'];
                      ?>
                    </td>
                    <td>
                      <?php 
                        $this->db->select_sum('tran_amount');
                        $this->db->where('acc_id', $each['acc_id']);
                        $this->db->where('tran_status', 2);
                        $totalCashOUT = $this->db->get('bank_transaction')->result_array();
                        echo $totalCashOUT[0]['tran_amount'];
                      ?>
                    </td>
                    <td>
                      <?php echo  $totalCashIN[0]['tran_amount']-$totalCashOUT[0]['tran_amount']?>
                    </td>
                  </tr>
                <?php endforeach; else: ?>
                  <tr class="text-center">
                    <td colspan="6">No Account Found</td>
                  </tr>
                <?php endif; ?>
                </tbody>
              </table>
            </div>

            <div class="tab-pane box" id="list">

            

            <form action="<?php echo base('a/accounting', 'transaction_search_date_wise'); ?>" method="post">
              <div class="row">
                  <div class="col-md-offset-1 col-md-2">
                    <h4>Date Search: </h4>
                  </div>
                  <div class="col-md-2">
                    <select name="acc_id" class="form-control">
                      <option value="">All Account</option>
                      <?php foreach($bank_accounts as $each): ?>
                          <option value="<?php echo $each['acc_id'] ?>"><?php echo $each['acc_name'].' ('.$each['acc_no'].')' ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <input type="text" name="fromDate" class="form-control datepicker" placeholder="From Date" required>
                  </div>
                  <div class="col-md-2">
                    <input type="text" name="toDate" class="form-control datepicker" placeholder="To Date" required>
                  </div>
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                  </div>
              </div>
            </form>
              <br>

                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Account Name</th>
                      <th>Account No.</th>
                      <th>Transaction</th>
                      <th class="sum">Amount</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php  if(!empty($bank_transactions)): 
                      $count = 0;
                      foreach($bank_transactions as $each): 
                      $key = array_search($each['acc_id'], array_column($bank_accounts, 'acc_id'));
                  ?>
                    <tr>
                      <td><?php echo $count += 1; ?></td>
                      <td><?php echo $bank_accounts[$key]['acc_name'];?></td>
                      <td><?php echo $bank_accounts[$key]['acc_no'];?></td>
                      <td  class="<?php echo $each['tran_status'] == 1?'cash-in':'cash-out';?>"><?php echo $each['tran_status'] == 1?'Cash IN':'Cash Out'; ?></td>
                      <td><?php echo $each['tran_amount']; ?></td>
                      <td><?php echo date('d-m-Y', $each['tran_date']); ?></td>
                      <td>
                        <a href="#" class="btn btn-xs btn-danger" onclick="confirm_modal('<?php echo base('a/accounting', 'delete_acc_transaction'.'/'.$each['tran_id']);?>');">Delete</a>
                      </td>
                    </tr>
                  <?php endforeach; else: ?>
                      <tr class="text-center">
                        <td colspan="6">No Transaction Found</td>
                      </tr>
                  <?php endif; ?>
                  </tbody>

                </table>
             
            </div>
            <!----TABLE LISTING ENDS--->


            <!----CREATION FORM STARTS---->
            <div class="tab-pane box" id="add" style="padding: 5px">
                  <form action="<?php echo base('a/accounting','add_bank_transaction'); ?>" method="post">
                      <div class="col-md-offset-1 col-md-7">
                            <h3 class="text-right">Add Transaction</h3>

                          <div class="form-group row">
                            <label class="col-md-4 col-form-label">Transaction Date</label>
                            <div class="col-md-8">
                              <input type="text" name="tran_date" class="form-control datepicker readonly-date" placeholder="Date" required="required">
                            </div>                              
                          </div>

                          <div class="form-group row">
                            <label class="col-md-4 col-form-label">Bank Account</label>
                            <div class="col-md-8">
                              <select name="acc_id" class="form-control" onchange="accountBalance(this.value)" required="required">
                                <option value="">Select Account</option>
                                <?php foreach($bank_accounts as $each): ?>
                                    <option value="<?php echo $each['acc_id'] ?>"><?php echo $each['acc_name'].' ('.$each['acc_no'].')' ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>                              
                          </div>

                          <div class="form-group row">
                            <label class="col-md-4 col-form-label">Transaction Status</label>
                            <div class="col-md-8">
                              <select name="tran_status" id="tran_status" class="form-control">
                                <option value="1">IN</option>
                                <option value="2">OUT</option>
                              </select>
                            </div>                              
                          </div>

                          <div class="form-group row">
                            <label class="col-md-4 col-form-label">Transaction Amount</label>
                            <div class="col-md-8">
                              <input type="text" name="tran_amount" id="tran_amount" class="form-control" placeholder="Amount" required="required">
                              <span id="amountMsg"></span>
                            </div>                              
                          </div>

                          <div class="form-group">
                              <button class="btn btn-info" id="saveTran" type="submit">Save</button>
                          </div>
                      </div>
                  </form>
                  <div class="col-md-4" id='currentBalanceHolder'>
                    <h3>Current Balance: <span id='currentBalance'></span> TK.</h3>
                    <h3>Last Withdrow: <span id='lastWithdrow'></span> TK.</h3>
                  </div>
            </div>
            <!----CREATION FORM ENDS-->
        </div>
    </div>
</div>



<script>

    $('#currentBalanceHolder').hide();     

    function accountBalance(id){
      $.ajax({
        url: '<?php echo base('a/accounting', 'grab_account_info').'/'; ?>' + id,
        success: function(responsce){
          var data = JSON.parse(responsce);
          $('#currentBalanceHolder').show();
          $('#currentBalance').html(data.account_balance);
          $('#lastWithdrow').html(data.last_withdrow);

          $('#tran_status').on('change',function(e){
            currentStatus = e.target.value;
              if(currentStatus == 2){
                $('#saveTran').attr('disabled', true);
                $('#tran_amount').on('change',function(e){
                currentBalance = document.getElementById("currentBalance");
                //console.log(e.target.value, currentBalance.innerHTML);
                if(e.target.value > currentBalance.innerHTML){
                  $('#amountMsg').html('Please Enter Amount Under ' + currentBalance.innerHTML + ' tk/=');
                  $('#amountMsg').css('color', 'red');
                  $('#saveTran').attr('disabled', true);
                }else{
                  $('#saveTran').attr('disabled', false); 
                }
              }); // END ON CHANGE INNER
            }else{
              $('#amountMsg').html('');  
              $('#saveTran').attr('disabled', false);
            } // END IF

          }); // END ON CHANGE OUTER 
          
        } // END AJAX SUCCESS
      }); // END AJAX MAIN FUNCTION
    } // END MOTHER FUNTON

    $(".readonly-date").keydown(function(e){
        e.preventDefault();
    });
</script>