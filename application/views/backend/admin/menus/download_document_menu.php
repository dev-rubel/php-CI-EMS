<style>
.extra-menu h2, 
.extra-menu h4{
    color: #fff;
}
.extra-menu {
    padding: 2px 10px !important;
    min-height: 40px;
}
.extra-menu h4 {
    font-size: 13px !important;
}
.customNavManu {
    margin-bottom: 20px;
    border-bottom: 1px solid #EEEEEE;
}
.panel-stat3 .stat-icon {
    top: 0 !important;
}

.panel-stat3 {
    border-radius: 0px !important;
}
</style>

<br>
<br>
<?php 
if($_SESSION['name']=='NihalIT'):
    $links = ['download_student_idcard', 'download_admit_card','download_seat_plan','download_excel'];
    $title = ['Download ID Card','Download Admit Card','Download Seat Plan','Download Excel'];
else:
    $links = ['download_student_idcard', 'download_admit_card'];
    $title = ['Download ID Card','Download Admit Card'];
endif;
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row customNavManu" id="documentNavManu">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-4 col-md-3" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info extra-menu" id="customNavBg<?php echo $each;?>">
                <!-- <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2> -->
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="customIcon fa" id="customNavIcon<?php echo $each; ?>"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
    <div class="col-sm-4 col-md-3" style="margin-bottom: 10px;">
        <a href="<?php echo base_url(); ?>index.php?Home/download_blank_form" target="_blank"> 
            <div class="panel-stat3 bg-info extra-menu<?php //echo $color[rand(1,7)];?>">
                <!-- <h2 class="m-top-none" id="userCount">3</h2> -->
                <h4>Download Admission Form</h4>

                <div class="stat-icon">
                    <i class="customIcon fa" id="customNavIcon"></i>
                </div>
            </div>
        </a>
    </div>

</div>




<div class="row" id="documentMainManu">

    <div class="menu-navigation-icons">
    <?php foreach($links as $k=>$each):?>
        <div class="col-sm-4 col-md-4" style="margin-bottom: 10px;">
            <a href="#" class="<?php echo manuColor($k);?>" onclick="changePage('<?php echo $each?>')">
                <i class="fa <?php echo fo_icon();?>"></i>
                <span><?php echo $title[$k];?></span>
            </a>
        </div>
        <!-- /.col -->
    <?php endforeach;?>
        <div class="col-sm-4 col-md-4" style="margin-bottom: 10px;">
            <a href="<?php echo base_url(); ?>index.php?Home/download_blank_form" class="<?php echo manuColor(1);?>" target="_blank">
                <i class="fa <?php echo fo_icon();?>"></i>
                <span>Download Admission Form</span>
            </a>
        </div>
    </div>

</div>



<div id="ajaxPageContainer"></div>


<script>

$('#documentNavManu').hide();
function changePage(page)
{
    var selectValue = page;
    /* ACTIVE MANU SECTION */
    $('.extra-menu').addClass('bg-info').removeClass('bg-success');
    $('.customIcon').removeClass('fa-thumb-tack');
    $('#customNavBg'+selectValue).addClass('bg-success').removeClass('bg-info');
    $('#customNavIcon'+selectValue).addClass('fa-thumb-tack');
    /* END ACTIVE MANU SECTION */
    
    $.ajax({
        type: "POST",
        data: {
            pageName : selectValue                
        },
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        url: '<?php echo base_url(); ?>index.php?admin/ajax_document_download_menu_pages',
        success: function (response)
        {   
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?admin/' + selectValue;
            window.history.pushState({path:newurl},'',newurl);                
            
            $('#documentNavManu').show();
            $('#documentMainManu').hide();
            $('#ajaxPageContainer').html(response);
            
            $('.datepicker').datepicker({
            	format: 'dd-mm-yyyy',
            });
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                
        }
    });
}

</script>