<?php
$session = $this->db->get_where('settings', array('type' => 'admission_session'))->row()->description;
$result = oneDim($this->db->get_where('admit_std',array('id'=>$param2))->result_array());
extract($result);
//pd($result);
?>

<div class="profile-env">
	
	<header class="row">
		
		<div class="col-sm-9">
			
			<ul class="profile-info-sections">
				<li style="padding:0px; margin:0px;">
					<div class="profile-name">
						<h3><?php echo $name;?></h3>
						<h3><?php echo $namebn;?></h3>
					</div>
				</li>
			</ul>
			
		</div>
		
		
	</header>
	
	<section class="profile-info-tabs">
		
		<div class="row">
			<div class="col-md-offset-1 col-md-10">
			
                    <form class="form-horizontal" action="<?php echo base('Home', 'update_admit_student') ?>" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="img" value="<?php echo $img; ?>">
                     
                        <div class="form-group">
                            <label for="inputText3" class="control-label"> 1. Student Name [English Block Letter]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="name" placeholder="Student Name" value="<?php echo $name;?>" data-validation="custom"
                                    data-validation-regexp="^([A-Za-z. ]+)$">
                            </div>                            
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label"> 2. Student Name [বাংলায়]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="namebn" value="<?php echo $namebn;?>" placeholder="শিক্ষার্থীর নাম বাংলায়"
                                    data-validation="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">3. Father's Name [English Block Letter]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="fname" placeholder="Fathers Name" value="<?php echo $fname;?>"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label"> 4. Father's Name [বাংলায়]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="fnamebn" value="<?php echo $fnamebn; ?>" placeholder="পিতার নাম বাংলায়"
                                    data-validation="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">5. Mother's Name [English Block Letter]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="mname" value="<?php echo $mname; ?>" placeholder="Mothers Name"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label"> 6. Mother's Name [বাংলায়]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="mnamebn" value="<?php echo $mnamebn; ?>" placeholder="মাতার নাম বাংলায়"
                                    data-validation="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">7. Permanent Address
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="paadress" value="<?php echo $paadress; ?>" placeholder="Vill: Homna, PO: Homna, Upazila: Homna, Dist: Homna"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">8. Present Address
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="praddress" value="<?php echo $praddress; ?>" placeholder="Present Address"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">9. Legal Guardian Name</label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="lguaridan" value="<?php echo $lguaridan; ?>" placeholder="Legal Guardian Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">10. Relation With Guardian</label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="relaguardian" value="<?php echo $relaguardian; ?>" placeholder="Relation With Guardian">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">11. Religion
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">

                                <select class="form-control" name="religion">
                                    <option <?php echo $religion=='Islam'?'selected':'';?>>Islam</option>
                                    <option <?php echo $religion=='Hindu'?'selected':'';?>>Hindu</option>
                                    <option <?php echo $religion=='Chirstian'?'selected':'';?>>Chirstian</option>
                                    <option <?php echo $religion=='Buddhist'?'selected':'';?>>Buddhist</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">12. Nationality
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="nationality" placeholder="Nationality" value="Bangladeshi" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">13. Previous School Name
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="preschoolname" value="<?php echo $preschoolname; ?>" placeholder="Previous School Name"
                                    data-validation="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">14. Previous School Address
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="preschooladd" value="<?php echo $preschooladd; ?>" placeholder="Previous School Address"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">15. Email</label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" value="<?php echo $email; ?>" name="email" placeholder="Email">
                            </div>
                        </div>
                        
                        
                        <?php $jscInfo = explode(',', $jscinfo); if(!empty($jscinfo)):?>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">B. JSC Info:
                                <span class="star">*</span>
                            </label>
                            
                            <div class="col-md-10 jscGrid" style="float: right">
                                <input type="text" class="form-control" value="<?php echo !empty($jscInfo[0])?$jscInfo[0]:''; ?>" name="jscinfo[]" placeholder="Year" data-validation="required" />
                                <input type="text" class="form-control" value="<?php echo !empty($jscInfo[1])?$jscInfo[1]:''; ?>" name="jscinfo[]" placeholder="Roll No." data-validation="required" />
                                <input type="text" class="form-control" value="<?php echo !empty($jscInfo[2])?$jscInfo[2]:''; ?>" name="jscinfo[]" placeholder="Reg. No." data-validation="required" />
                                <input type="text" class="form-control" value="<?php echo !empty($jscInfo[3])?$jscInfo[3]:''; ?>" name="jscinfo[]" placeholder="GPA" data-validation="required" />
                            </div>
                        </div>
                        <?php endif;?>
                        
                        <div class="form-group">
                            <!-- Date input -->
                            <label for="inputText3 date" class="control-label">17. Date of Birth
                                <span class="star">*</span>
                            </label>

                            <div class="input-group col-md-8" style="float: right">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="date" name="date" data-date-format="dd/mm/yyyy" value="<?php echo $date; ?>"
                                    placeholder="DD/MM/YYYY" type="text" required="required" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputText3" class="control-label">18. Guardian Mobile No
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="mobile" value="<?php echo $mobile; ?>" placeholder="Guardian Mobile No"
                                    data-validation="custom" data-validation-regexp="^([0-9]+)$" data-validation-error-msg="Input Only Accept 0 to 9"
                                />
                            </div>
                        </div>

                        <div class="form-group preview-img">

                            <div id="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="img" id="image-upload" data-validation="dimension mime size required" data-validation-allowing="jpg, png, gif"
                                    data-validation-dimension="max300x300" data-validation-max-size="100kb" />
                            </div>
                            <p class="help-block ">Attach a Passport Size Picture. Max File Size 100KB & Max Resolution 300 x 300 px.
                                <span class="star">*</span>
                            </p>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <input type="submit" value="Submit" class="btn btn-info" onclick="return confirm('Are you sure your all information currect?');return false;">
                            </div>
                        </div>
                    </form>

            </div>
				<div>
			</div>
		</div>			
		
				<br>
		
		</div>
	</div>		
</section>
	
	
	
</div>

