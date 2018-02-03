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

<div class="row" id="admissionMainManu">

    <div class="menu-navigation-icons">

        <div class="col-sm-6 col-md-4" style="margin-bottom: 10px;">
            <a href="<?php echo base_url(); ?>index.php?Home/download_blank_form" class="<?php echo manuColor(1);?>" onclick="changePage('<?php echo $each?>')">
                <i class="fa <?php echo fo_icon();?>"></i>
                <span>Download Admission Form</span>
            </a>
        </div>

    </div>

</div>

<script>
$('#admissionNavManu').hide();
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