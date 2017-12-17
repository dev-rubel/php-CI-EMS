    <div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/logo.png"  style="max-height:60px;"/>
            </a>
        </div>
    </header>

    <div style=""></div>	
    <div class="content">
         <ul class="vertical-nav dark red">

            <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
                <a href="<?php echo base_url(); ?>index.php?admin/dashboard"><i class="entypo-gauge"></i> 
                <?php echo get_phrase('dashboard'); ?>
                </a>
            </li>

            <li class="<?php
        if ($page_name == 'home/logoPage' ||
                $page_name == 'home/schoolNamePage' ||
                $page_name == 'home/socialLinkPage' ||
                $page_name == 'home/sliderPage' ||
                $page_name == 'home/noticePage' ||
                $page_name == 'home/importantNoticePage' ||
                $page_name == 'home/managePages' ||
                $page_name == 'home/importantLinkPage' ||
                $page_name == 'home/locationPage' ||
                $page_name == 'home/galleryPage' ||
                $page_name == 'home/presentPage' 
                )
            echo 'active';
        ?> ">
               <a href="#"><i class="entypo-window"></i><?php echo get_phrase('manage_home'); ?> <span class="submenu-icon"></span></a>
               <ul>
                  <li style="display: none;"><a href="#"><?php echo get_phrase('header'); ?> <span class="submenu-icon"></span></a>
                      <ul>
                          <li><a href="<?php echo base_url(); ?>index.php?homemanage/change_logo"><?php echo get_phrase('logo'); ?></a></li>
                          <li><a href="<?php echo base_url(); ?>index.php?homemanage/school_name"><?php echo get_phrase('school_name'); ?></a></li>
                      </ul>
                  </li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/social_link"><?php echo get_phrase('social_link'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/slider"><?php echo get_phrase('slider'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/important_notice"><?php echo get_phrase('important_notice'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/notice"><?php echo get_phrase('notice'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/manage_pages"><?php echo get_phrase('manage_pages'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/important_link"><?php echo get_phrase('important_links'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/location"><?php echo get_phrase('location'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/present"><?php echo get_phrase('present_page'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/gallery"><?php echo get_phrase('gallery'); ?></a></li>
               </ul>
            </li>
            <li class="<?php
        if ($page_name == 'student_add' ||
                $page_name == 'student_bulk_add' ||
                $page_name == 'student_information' ||
                $page_name == 'student_marksheet' ||
                $page_name == 'student_promotion' ||
                $page_name == 'home/admission_query' ||
                $page_name == 'home/admission_result' 
                
                )
            echo 'active';
        ?> ">
               <a href="#"><i class="entypo-rocket"></i><?php echo get_phrase('student'); ?> <span class="submenu-icon"></span></a>
               <ul>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/student_add"><?php echo get_phrase('admit_student'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/student_bulk_add"><?php echo get_phrase('admit_bulk_student'); ?></a></li>
                  <li><a href="#"><?php echo get_phrase('student_information'); ?> <span class="submenu-icon"></span></a>
                      <ul>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            $groupName = $this->db->get_where('group', array('class_id' => $row['class_id']))->result_array();
                            if(!empty($groupName)):
                            ?>
                        
                            <li>
                                <a href="#"><?php echo get_phrase('class').' '.$row['name']; ?> <span class="submenu-icon"></span></a>
                                <ul>
                                    <?php foreach($groupName as $each): ?>
                                        <li>
                                            <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id'].'/'.$each['group_id']; ?>">
                                                <?php echo get_phrase($each['name']); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>

                        <?php else: ?>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php?admin/student_information/<?php echo $row['class_id']; ?>">
                                    <?php echo get_phrase('class').' '.$row['name']; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </ul>
                  </li>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/total_student_page"><?php echo get_phrase('total_student'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/student_promotion"><?php echo get_phrase('student_promotion'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/admission_query"><?php echo get_phrase('admission_query'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?homemanage/admission_result"><?php echo get_phrase('admission_result'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/testimonial_voc"><?php echo get_phrase('testimonial_for_voc'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/testimonial_general"><?php echo get_phrase('testimonial_for_general'); ?></a></li>
                  <li><a href="<?php echo base_url(); ?>index.php?admin/download_excel"><?php echo get_phrase('download_excel'); ?></a></li>
                  
               </ul>
            </li>
            <li class="<?php if ($page_name == 'teacher') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/teacher"><i class="entypo-users"></i> <?php echo get_phrase('teacher'); ?></a></li>
            <li class="<?php if ($page_name == 'parent') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/parent"><i class="entypo-user"></i> <?php echo get_phrase('parents'); ?></a></li>

            <?php if($_SESSION['name']=='NihalIT'): ?>
            <li class="<?php if ($page_name == 'librarian') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/librarian"><i class="entypo-book"></i> <?php echo get_phrase('librarian'); ?></a></li>
            <?php endif; ?>


            <li class="<?php
        if ($page_name == 'class' ||
                $page_name == 'section' ||
                $page_name == 'shift' ||
                $page_name == 'group' ||
                $page_name == 'academic_syllabus' 
				)
            echo 'opened active';
        ?> "><a href="#"><i class="entypo-flow-tree"></i> <?php echo get_phrase('class'); ?> <span class="submenu-icon"></span></a> 
                <ul>
                <li><a href="<?php echo base_url(); ?>index.php?admin/classes"><?php echo get_phrase('manage_classes'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>index.php?admin/shifts"><?php echo get_phrase('manage_shifts'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>index.php?admin/groups"><?php echo get_phrase('manage_groups'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>index.php?admin/section"><?php echo get_phrase('manage_sections'); ?></a></li>
                <li><a href="<?php echo base_url(); ?>index.php?admin/academic_syllabus"><?php echo get_phrase('academic_syllabus'); ?></a></li>
                </ul>
            
            </li>
            <li class="<?php if ($page_name == 'subject') echo 'opened active'; ?> "><a href="#"><i class="entypo-docs"></i> <?php echo get_phrase('subject'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php?admin/subject/<?php echo $row['class_id']; ?>">
                            <span><?php echo get_phrase('class').' '.$row['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </li>

           <!-- CLASS ROUTINE SECTION -->
           
            <li class="<?php
        if ($page_name == 'class_routine_view' ||
                $page_name == 'class_routine_add')
            echo 'active';
        ?> "><a href="#"><i class="entypo-target"></i> <?php echo get_phrase('class_routine'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                    <li>
                        <a href="#">
                            <?php echo get_phrase('class').' '.$row['name']; ?>
                            <span class="submenu-icon"></span>
                        </a>
                        <?php $cGroups = $this->db->get_where('group', array('class_id'=>$row['class_id']))->result_array(); 
                            if(count($cGroups)):                                
                        ?>
                        <ul>
                            <?php foreach($cGroups as $eachGro): ?>
                            <li>
                                <a href="#"><?php echo ucfirst($eachGro['name']); ?>
                                    <span class="submenu-icon"></span>
                                </a>
                                <ul>
                                <?php $sName = $this->db->get('shift')->result_array(); 
                                    foreach($sName as $eachShift):
                                ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php?admin/class_routine_view/<?php echo $row['class_id'].'/'.$eachGro['group_id'].'/'.$eachShift['shift_id'].'/G'; ?>"><?php echo $eachShift['name']; ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <?php else: ?>
                        <?php $cSections = $this->db->get_where('section', array('class_id'=>$row['class_id']))->result_array();                                
                        ?>
                        <ul>
                            <?php foreach($cSections as $eachSec): ?>
                            <li>
                                <a href="#"><?php echo $eachSec['name']; ?>
                                    <span class="submenu-icon"></span>
                                </a>
                                <ul>
                                <?php $sName = $this->db->get('shift')->result_array(); 
                                    foreach($sName as $eachShift):
                                ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>index.php?admin/class_routine_view/<?php echo $row['class_id'].'/'.$eachSec['section_id'].'/'.$eachShift['shift_id']; ?>"><?php echo $eachShift['name']; ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                </ul>
            </li>

            <!-- MANAGE ATTENDANCE SECTION -->

            <li class="<?php
        if ($page_name == 'manage_attendance' ||
                $page_name == 'manage_attendance_view' || $page_name == 'attendance_report' || $page_name == 'attendance_report_view')
            echo 'active';
        ?> "><a href="#"><i class="entypo-chart-area"></i> <?php echo get_phrase('daily_attendance'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/manage_attendance"><?php echo get_phrase('daily_atendance'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/attendance_report"><?php echo get_phrase('attendance_report'); ?></a></li>
                </ul>
            </li>
            <li class="<?php
        if ($page_name == 'exam' ||
                $page_name == 'grade' ||
                $page_name == 'marks_manage' ||
                $page_name == 'exam_marks_sms' ||
                $page_name == 'tabulation_sheet' ||
                $page_name == 'marks_manage_view' || 
                $page_name == 'question_paper')
            echo 'active';
        ?> "><a href="#"><i class="entypo-graduation-cap"></i> <?php echo get_phrase('exam'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/exam"><?php echo get_phrase('exam_list'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/grade"><?php echo get_phrase('exam_grades'); ?></a></li>

                    <?php if($_SESSION['name']=='NihalIT'): ?>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/marks_manage"><?php echo get_phrase('manage_marks'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/exam_marks_sms"><?php echo get_phrase('send_marks_by_sms'); ?></a></li>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/tabulation_sheet"><?php echo get_phrase('tabulation_sheet'); ?></a></li>
                    <?php endif; ?>

                    <li><a href="<?php echo base_url(); ?>index.php?admin/question_paper"><?php echo get_phrase('question_paper'); ?></a></li>
                </ul>
            </li>
            
            <!-- <li class="<?php if ($page_name == 'invoice') echo 'active'; ?> "><a href="<?php echo base_url();?>index.php?admin/invoice"><i class="entypo-credit-card"></i> <?php echo get_phrase('payment'); ?></a></li> -->

            <?php if($_SESSION['name']=='NihalIT'): ?>
            <li class="<?php if ($page_name == 'book') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/book"><i class="entypo-book"></i> <?php echo get_phrase('library'); ?></a></li>
            <?php endif; ?>
            

            <li class="<?php if ($page_name == 'noticeboard') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/noticeboard"><i class="entypo-doc-text-inv"></i> <?php echo get_phrase('noticeboard'); ?></a></li>
            <li class="<?php if ($page_name == 'message') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/message"><i class="entypo-mail"></i> <?php echo get_phrase('message'); ?></a></li>

            <?php if($_SESSION['name']=='NihalIT'): ?>
            <li class="<?php
        if ($page_name == 'system_settings' ||
                $page_name == 'manage_language' ||
                $page_name == 'sms_settings')
            echo 'active';
        ?> "><a href="#"><i class="entypo-lifebuoy"></i> <?php echo get_phrase('settings'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/system_settings"><?php echo get_phrase('general_settings'); ?></a></li>
                    
                    <?php if($_SESSION['name']=='NihalIT'): ?>
                    <li><a href="<?php echo base_url(); ?>index.php?admin/sms_settings"><?php echo get_phrase('sms_settings'); ?></a></li>
                    <?php endif; ?>

                    <li><a href="<?php echo base_url(); ?>index.php?admin/manage_language"><?php echo get_phrase('language_settings'); ?></a></li>                                 

                </ul>
            </li>
            <?php endif; ?>

            <li class="<?php if ($page_name == 'sendresultsms') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/send_result_sms"><i class="entypo-chat"></i>      <?php echo get_phrase('SendSMS'); ?></a></li> 

            <li class="<?php if ($page_name == 'manage_profile') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/manage_profile"><i class="entypo-lock"></i> <?php echo get_phrase('account'); ?></a></li>



            <?php if($_SESSION['name']=='NihalIT'): ?>

            
            <!-- ACCOUNTING SECTION  -->
            <li><a href="#"><i class="entypo-suitcase"></i> <?php echo get_phrase('accounting'); ?> <span class="submenu-icon"></span></a>
                <ul>
                    <li><a href="<?php echo base_url(); ?>index.php?a/accounting/student_payment"><?php echo get_phrase('create_student_payment'); ?></a></li>
                    
                    <!--<li><a href="<?php echo base_url(); ?>index.php?a/accounting/expense"><?php echo get_phrase('expense'); ?></a></li>-->

                    <li>
                        <a href="#"><?php echo get_phrase('payment'); ?> <span class="submenu-icon"></span></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/income"><?php echo get_phrase('student_payments'); ?></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/income_category"><?php echo get_phrase('payment_category'); ?></a></li>
                        </ul>
                    </li>
                    
                    
                    <li>
                        <a href="#"><?php echo get_phrase('expense'); ?> <span class="submenu-icon"></span></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/daily_expense"><?php echo get_phrase('daily_expense'); ?></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/expense_category"><?php echo get_phrase('expense_category'); ?></a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><?php echo get_phrase('report'); ?> <span class="submenu-icon"></span></a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/monthly_expense_sheet"><?php echo get_phrase('monthly_expense_sheet'); ?></a></li>
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/monthly_balance_sheet"><?php echo get_phrase('monthly_balance_sheet'); ?></a></li>                    
                            <li><a href="<?php echo base_url(); ?>index.php?a/accounting/total_balance_sheet"><?php echo get_phrase('total_balance'); ?></a></li>
                        </ul>
                    </li>

                    


                    <!--<li><a href="<?php echo base_url(); ?>index.php?a/accounting/account_balence_sheet"><?php echo get_phrase('balance_sheet'); ?></a></li>-->
                    <!--<li><a href="<?php echo base_url(); ?>index.php?a/accounting/category_balence_sheet"><?php echo get_phrase('balance_sheet two'); ?></a></li>-->
                    <?php if($_SESSION['name']=='NihalIT'): ?>
                        <li>
                            <a href="#"><?php echo get_phrase('bank'); ?> <span class="submenu-icon"></span></a>
                            <ul>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php?a/accounting/manage_bank_ac"><?php echo get_phrase('manage_account'); ?></a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php?a/accounting/bank_transaction"><?php echo get_phrase('transaction'); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>

            <!-- END ACCOUNTING SECTION  -->






            <li class="<?php if ($page_name == 'transport') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/transport"><i class="entypo-location"></i> <?php echo get_phrase('transport'); ?></a></li>
            <li class="<?php if ($page_name == 'dormitory') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/dormitory"><i class="entypo-home"></i> <?php echo get_phrase('dormitory'); ?></a></li>

            
            <li class="<?php if ($page_name == 'database_structure') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/database_structure"><i class="entypo-database"></i>      <?php echo get_phrase('database'); ?></a></li>  
            <li class="<?php if ($page_name == 'directory') echo 'active'; ?> "><a href="<?php echo base_url(); ?>index.php?admin/directory"><i class="entypo-folder"></i>      <?php echo get_phrase('directory'); ?></a></li>  


            <?php endif; ?>
         </ul>
      </div>

</div>