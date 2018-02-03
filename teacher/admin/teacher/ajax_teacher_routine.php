<table class="table table-bordered">
    <thead>
        <tr>
            <th>Days</th>
            <th>Time</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2" class="text-center">
                <b>Teacher Name: </b><?php echo $this->db->get_where('teacher',['teacher_id'=>$teacher_id])->row()->name;?>
            </td>
        </tr>
        <?php foreach(range(1,7) as $k=>$each): 
            $day = date("l", mktime(0,0,0,8,$each,2017));
            if($day != 'Friday'):
            $routine = $this->db->get_where('class_routine',['day'=>$day,'teacher_id'=>$teacher_id])->result_array();
        ?>
        <tr>
            <td>
                <?php echo $day;?>
            </td>
            <td>
                <?php if(!empty($routine)): foreach($routine as $ke=>$each2):?>
                <div class="btn-group">
                    <button class="btn btn-default">
                        <?php 
                                if ($each2['time_start_min'] == 0 && $each2['time_end_min'] == 0) 
                                //echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                                echo date("g:i a", strtotime($each2['time_start'].':'.$each2['time_end']));
                            if ($each2['time_start_min'] != 0 || $each2['time_end_min'] != 0)
                                echo '('.date("g:i", strtotime($each2['time_start'].':'.$each2['time_start_min'])).'-';
                                echo date("g:i A", strtotime($each2['time_end'].':'.$each2['time_end_min'])).')';
                            
                            ?>
                    </button>
                </div>
                <?php endforeach; endif;?>
            </td>
        </tr>
        <?php endif; endforeach;?>

    </tbody>
</table>