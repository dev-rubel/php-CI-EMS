<form id="updateAdmissionInfo" action="<?php echo base_url() .'index.php?homemanage/ajax_update_admission_info'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   

<script>

$(document).ready(function() { 
    /* Change Password */
    // toastr.options.positionClass = 'toast-bottom-right';

    $('#addResult').ajaxForm({ 
        beforeSend: function() {                
                $('#loading2').show();
                $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);  

            if(!jData.type) {    
                toastr.error(jData.msg);
            } else {
                toastr.success(jData.msg);  
                $( "#admission_result_section_holder" ).html( jData.html );
                               
            }   
            $('body,html').animate({scrollTop:0},800);         
            $('#loading2').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                   
        }
    }); 


});

</script>


<?php
function jsonMsgReturn($type, $msg, $html='') 
{
    echo json_encode(['type'=>$type,'msg'=>$msg,'html'=>$html]);
}

$htmlData = $this->load->view('backend/admin/ajax_elements/update_admission_info' , $page_data, true);
$this->jsonMsgReturn(true,'Information Updated.',$htmlData);

$check = check_array_value($_POST, 'userfile');
        if(!$check){
            $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
        } else {
        }
?>