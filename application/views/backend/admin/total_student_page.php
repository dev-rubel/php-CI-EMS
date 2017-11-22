<style>
.bg-sms{
	background-color: #9684A3;
    color: #fff;
}
.bg-today-app{
	background-color: #83D6DE;
    color: #fff;
}
.bg-confirm-app{
	background-color: #D1D6A9;
    color: #fff;
}
.bg-padding-app{
	background-color: #FEC606;
    color: #fff;
}
</style>

<?php $all_class = $this->db->get('class')->result_array(); ?>
  <div class="row">
    <div class="col-md-12">
          	<br><br>
      <!-- tabs left -->
      <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
        <?php foreach($all_class as $k=>$list): ?>
          <li class="<?php echo $k==0?'active':'';?>"><a href="#a<?php echo $k; ?>" data-toggle="tab"><?php echo $list['name']; ?></a></li>
      	<?php endforeach; ?>
        </ul>
        <div class="tab-content">
        <?php foreach($all_class as $k=>$list): ?>
         <div class="tab-pane <?php echo $k==0?'active':'';?>" id="a<?php echo $k; ?>">
         <?php 
         	$this->db->where('class_id', $list['class_id']);
			$this->db->from('enroll');
			$class_total_student = $this->db->count_all_results(); // Produces an integer, like 17
          ?>
         	<div class="panel col-sm-2 col-md-2">
		        <div class="panel-stat3 bg-sms">
		            <h3 class="m-top-none" id="userCount"><?php echo $class_total_student; ?></h3>
		            <h5>Total Student</h5>
		            
		            <div class="stat-icon">
		                <i class="fa fa-graduation-cap fa-1x"></i>
		            </div>
		        </div>
		    </div>

		    <?php 
		    $sections = $this->db->get_where('section', array('class_id'=>$list['class_id']))->result_array(); 
		    if(count($sections) > 0):
		    	foreach($sections as $k2=>$list2):
		    		$this->db->where('class_id', $list['class_id']);
		    		$this->db->where('section_id', $list2['section_id']);
					$this->db->from('enroll');
					$section_total_student = $this->db->count_all_results(); 
					$k2++;
		    ?>
         	<div class="panel col-sm-2 col-md-2">
		        <div class="panel-stat3 <?php echo $k2%2==0?'bg-today-app':'bg-padding-app' ?>">
		            <h3 class="m-top-none" id="userCount"><?php echo $section_total_student; ?></h3>
		            <h5>Section <?php echo $list2['name']; ?></h5>
		            
		            <div class="stat-icon">
		                <i class="fa fa-graduation-cap fa-1x"></i>
		            </div>
		        </div>
		    </div>
			<?php 
				endforeach;
			endif; 
			?>

         </div>
         <?php endforeach; ?>
        </div>
      </div>
      <!-- /tabs -->
      
    </div>   
  </div><!-- /row -->