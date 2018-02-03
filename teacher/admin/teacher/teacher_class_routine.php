
                <br><br>
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <?php foreach(range(1,7) as $k=>$each): 
                                    $day = date("l", mktime(0,0,0,8,$each,2017));
                                    if($day != 'Friday'):
                                ?>
                                <th>
                                    <?php echo $day;?>             
                                </th>
                            <?php endif; endforeach;?>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $teachers	=	$this->db->get('teacher' )->result_array();
                                foreach($teachers as $row):?>
                        <tr>
                            <td></td>
                            <td><?php echo $row['name'];?></td>
                            <?php foreach(range(1,7) as $k=>$each):
                                $day = date("l", mktime(0,0,0,8,$each,2017));
                                if($day != 'Friday'):
                                $routine = $this->db->get_where('class_routine',['day'=>$day,'teacher_id'=>$row['teacher_id']])->result_array();
                                ?>
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
                            <?php endif; endforeach; ?>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

