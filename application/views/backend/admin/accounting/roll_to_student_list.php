<style>
/* start radio button styles */
    .funkyradio div {
        clear: both;
        overflow: hidden;
    }

    .funkyradio label {
        width: 100%;
        border-radius: 3px;
        border: 1px solid #D1D3D4;
        font-weight: normal;
    }

    .funkyradio input[type="radio"]:empty,
    .funkyradio input[type="checkbox"]:empty {
        display: none;
    }

    .funkyradio input[type="radio"]:empty ~ label,
    .funkyradio input[type="checkbox"]:empty ~ label {
        position: relative;
        line-height: 2.5em;
        text-indent: 3.25em;
        /* margin-top: 2em; */
        cursor: pointer;
        -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
                user-select: none;
    }

    .funkyradio input[type="radio"]:empty ~ label:before,
    .funkyradio input[type="checkbox"]:empty ~ label:before {
        position: absolute;
        display: block;
        top: 0;
        bottom: 0;
        left: 0;
        content: '';
        width: 2.5em;
        background: #D1D3D4;
        border-radius: 3px 0 0 3px;
    }

    .funkyradio input[type="radio"]:hover:not(:checked) ~ label,
    .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
        color: #888;
    }

    .funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
    .funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
        content: '\2714';
        text-indent: .9em;
        color: #C2C2C2;
    }

    .funkyradio input[type="radio"]:checked ~ label,
    .funkyradio input[type="checkbox"]:checked ~ label {
        color: #777;
    }

    .funkyradio input[type="radio"]:checked ~ label:before,
    .funkyradio input[type="checkbox"]:checked ~ label:before {
        content: '\2714';
        text-indent: .9em;
        color: #333;
        background-color: #ccc;
    }

    .funkyradio input[type="radio"]:focus ~ label:before,
    .funkyradio input[type="checkbox"]:focus ~ label:before {
        box-shadow: 0 0 0 3px #999;
    }

    .funkyradio-default input[type="radio"]:checked ~ label:before,
    .funkyradio-default input[type="checkbox"]:checked ~ label:before {
        color: #333;
        background-color: #ccc;
    }

    .funkyradio-primary input[type="radio"]:checked ~ label:before,
    .funkyradio-primary input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #337ab7;
    }

    .funkyradio-success input[type="radio"]:checked ~ label:before,
    .funkyradio-success input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #5cb85c;
    }

    .funkyradio-danger input[type="radio"]:checked ~ label:before,
    .funkyradio-danger input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #d9534f;
    }

    .funkyradio-warning input[type="radio"]:checked ~ label:before,
    .funkyradio-warning input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #f0ad4e;
    }

    .funkyradio-info input[type="radio"]:checked ~ label:before,
    .funkyradio-info input[type="checkbox"]:checked ~ label:before {
        color: #fff;
        background-color: #5bc0de;
        }
    /* end radio button styles */


</style>
<div class="form-group">
    <div class="row">
    <?php if(!empty($student_class) && !empty($student_roll)):
            $class_id = $this->db->get_where('class',['name_numeric'=>$student_class])->row()->class_id;
            if(!empty($class_id)):
                $data = ['class_id'=>$class_id,'roll'=>$student_roll];
                $students = $this->db->get_where('enroll',$data)->result_array();
                    if(!empty($students)):
                foreach($students as $k=>$each):
                    $stdName = $this->db->get_where('student',['student_id'=>$each['student_id']])->row()->name;
        ?>
    <div class="col-sm-3">
        <div class="funkyradio">
            <div class="funkyradio-success">
                <input type="radio" name="radio" value="<?php echo $each['student_id'];?>" class="radio" id="radio<?php echo $k?>" />
                <label for="radio<?php echo $k?>"><?php echo $stdName;?></label>
            </div>      
        </div>
    </div>
                <?php endforeach; 
                echo '</row>';
                else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;
                else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;
                else: echo '<p class="text-center"><b>No Student Found</b></p>'; endif;?>

</div>

<script>
$(document).ready(function () {
       $('.radio').click(function () {
           console.log($(this).val());
       });

   });
</script>