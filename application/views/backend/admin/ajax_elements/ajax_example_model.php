<form id="updateAdmissionInfo" action="<?php echo base_url() .'index.php?homemanage/ajax_update_admission_info'; ?>" class="form-horizontal form-groups-bordered validate" method="post">   

<script>

$(document).ready(function() { 
    /* Change Password */
    // toastr.options.positionClass = 'toast-bottom-right';

    $('#updateSmsSetting').ajaxForm({ 
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
                $('#myFormId').resetForm();               
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


function ajax_create_shift()
{
    $check = check_array_value($_POST);
    if(!$check){
        $this->jsonMsgReturn(false,'Please Fill All Field Properly.');
    } else {      
        $data['name']         = $this->input->post('name');
        $this->db->insert('shift', $data);
        $shift_id = $this->db->insert_id();

        $page_data['shifts']    = $this->db->get('shift')->result_array();
        
        $htmlData = $this->load->view('backend/admin/ajax_elements/shift_table_holder' , $page_data, true);
        $this->jsonMsgReturn(true,'Shift Created.',$htmlData);
    }
}

function ajax_edit_shift()
{
    $shift_id = $this->uri(3);
    $page_data['shift_id']   = $shift_id;
    $htmlData = $this->load->view('backend/admin/ajax_elements/edit_shift_holder' , $page_data, true);
    $this->jsonMsgReturn(true,'Edit Moad ON',$htmlData);
}


function ajax_update_shift()
{
    $class_id = $this->uri(3);        
    $this->db->where('shift_id', $class_id);
    $this->db->update('shift', $_POST);

    $page_data['shifts']    = $this->db->get('shift')->result_array();
    $htmlData = $this->load->view('backend/admin/ajax_elements/shift_table_holder' , $page_data, true);
    $this->jsonMsgReturn(true,'Edit Success.',$htmlData);
}
?>