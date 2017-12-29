<style>
.panel-stat3 h2,h4{
    color: #fff;
}
.extra-menu {
    padding: 2px 10px !important;
    min-height: 60px;
}
.extra-menu h4 {
    font-size: 13px !important;
}
.customNavManu {
    margin-bottom: 20px;
    border-bottom: 1px solid #EEEEEE;
}
</style>
<br>
<br>
<?php 
$links = ['admission_query','admission_result'];
$title = ['Admission Query','Admission Result'];
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row customNavManu" id="admissionNavManu">

<div class="col-md-1"></div>
<?php foreach($links as $k=>$each):?>
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info extra-menu" id="<?php echo $each;?>">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>

    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="<?php echo base_url(); ?>index.php?Home/download_blank_form"> 
            <div class="panel-stat3 bg-info extra-menu<?php //echo $color[rand(1,7)];?>">
                <h2 class="m-top-none" id="userCount">3</h2>
                <h4>Download Admission Form</h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-2x"></i>
                </div>
            </div>
        </a>
    </div>

</div>








<div class="row" id="admissionMainManu">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-3x"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>

    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="<?php echo base_url(); ?>index.php?Home/download_blank_form">
            <div class="panel-stat3 bg-info<?php //echo $color[rand(1,7)];?>">
                <h2 class="m-top-none" id="userCount">3</h2>
                <h4>Download Admission Form</h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-3x"></i>
                </div>
            </div>
        </a>
    </div>

</div>

<div id="ajaxPageContainer"></div>


<script>
$('#admissionNavManu').hide();
function changePage(page)
{
    var selectValue = page;
    
    $.ajax({
        type: "POST",
        data: {
            pageName : selectValue                
        },
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        url: '<?php echo base_url(); ?>index.php?homemanage/ajax_admission_menu_pages',
        success: function (response)
        {   
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?homemanage/' + selectValue;
            window.history.pushState({path:newurl},'',newurl);                
            // var cName = $('#'+selectValue).hasClass('bg-info'); 
            // if(cName){
            //     $("#"+selectValue).removeClass("bg-info");
            //     $("#"+selectValue).addClass("bg-primary");
            // } else {
            //     $("#"+selectValue).addClass("bg-info");
            //     $("#"+selectValue).removeClass("bg-primary");
            // }
            // if(cName.contains("bg-info")){
            //     console.log("String Found");
            // }
            //$("#"+selectValue).removeClass("bg-info");
            //$("#"+selectValue).toggleClass("bg-primary");
            $('#admissionNavManu').show();
            $('#admissionMainManu').hide();
            $('#ajaxPageContainer').html(response);

            $('#admission_link_status').bootstrapToggle();
            $(".admissionTable").dataTable();
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                
        }
    });
}

</script>