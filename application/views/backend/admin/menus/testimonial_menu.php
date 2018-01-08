<style>
.extra-menu h2,  
.extra-menu h4{
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
$links = ['testimonial_voc','testimonial_general'];
$title = ['Testimonial For Vocational','Testimonial For General'];
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row customNavManu" id="testimonialNavManu">

<div class="col-md-3"></div>
<?php foreach($links as $k=>$each):?>
    <div class="col-sm-3 col-md-3" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info extra-menu" id="customNavBg<?php echo $each;?>">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="customIcon fa fa-bars" id="customNavIcon<?php echo $each; ?>"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
</div>


<div class="row" id="testimonialMainManu">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="#" onclick="changePage('<?php echo $each?>')">
            <div class="panel-stat3 bg-info<?php //echo $color[rand(1,7)];?>">
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
</div>


<div id="ajaxPageContainer"></div>


<script>

$('#testimonialNavManu').hide();
function changePage(page)
{
    var selectValue = page;
    /* ACTIVE MANU SECTION */
    $('.extra-menu').addClass('bg-info').removeClass('bg-success');
    $('.customIcon').addClass('fa-bars').removeClass('fa-thumb-tack');
    $('#customNavBg'+selectValue).addClass('bg-success').removeClass('bg-info');
    $('#customNavIcon'+selectValue).addClass('fa-thumb-tack').removeClass('fa-bars');
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
        url: '<?php echo base_url(); ?>index.php?admin/ajax_testimonial_menu_pages',
        success: function (response)
        {   
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?admin/' + selectValue;
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
            $('#testimonialNavManu').show();
            $('#testimonialMainManu').hide();
            $('#ajaxPageContainer').html(response);
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                
        }
    });
}

</script>