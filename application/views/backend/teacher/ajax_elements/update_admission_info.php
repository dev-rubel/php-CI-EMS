<div class="form-group">
	<label for="exampleInputName2">Admission Exam Date</label>
	<input type="text" name="admission_exam_date" class="form-control" id="exampleInputName2" placeholder="EG.16 December" value="<?php echo $admission_exam_date;?>">
</div>
<div class="form-group">
	<label for="exampleInputEmail2">Admission Exam Time</label>
	<input type="text" name="admission_exam_time" class="form-control" placeholder="EG.10:00PM/10:00AM" value="<?php echo $admission_exam_time;?>">
</div>
<div class="form-group">
	<label for="exampleInputEmail2">Admission Mark Distribution</label>
	<input type="text" name="admission_exam_mark" class="form-control" placeholder="Bangla 30 + English 30 + Math 40 = 100" value="<?php echo $admission_exam_mark;?>">
</div>
<div class="form-group">
	<label for="exampleInputEmail2">SMS Title</label>
	<input type="text" name="admission_sms_title" class="form-control" placeholder="title" value="<?php echo $admission_sms_title;?>"
	    <?php echo !empty($nihalit)? '': 'readonly="readonly"'?>>
</div>
<div class="form-group">
	<label for="exampleInputEmail2">SMS Description</label>
	<textarea class="form-control" name="admission_sms_description" placeholder="Description" <?php echo !empty($nihalit)? '':
	    'readonly="readonly"'?>><?php echo $admission_sms_description;?></textarea>
</div>
<div class="form-group">
	<label for="exampleInputEmail2">Admission Page: &nbsp;</label>
	<input type="checkbox" name="admission_link_status" id="admission_link_status" data-toggle="toggle" <?php echo $admission_link_status==1?
	    'checked': ''?>>
</div>
<div class="form-group">
	<label for="exampleInputName2">Admission Session: </label>
	<select name="admission_session" class="form-control" id="exampleInputName2">
		<?php foreach(range(2016, date('Y')+1) as $k=>$each):?>
		<option value="<?php echo $each;?>" <?php echo $admission_session==$each? 'selected': '';?>>
			<?php echo $each;?>
		</option>
		<?php endforeach;?>
	</select>
</div>