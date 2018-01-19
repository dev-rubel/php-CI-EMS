<style type="text/css">
    .container {
        padding: 0px;
    }
</style>
<?php
$schoolInfo = $this->db->get_where('settings',['type'=>'school_information'])->row()->description;
list($schoolName,$schoolAddress,$eiin,$email,$phone) = explode('+', $schoolInfo);

$this->db->where('type', 'admission_link_status');
$result1 = oneDim($this->db->get('settings')->result_array());
if ($result1['description'] == 0):
    ?>
    <div class="container box-form">
        <div class="col-md-8 col-md-offset-2">
            <div class="text-center" style="padding: 50px 0px;">
                <img src="assets/disconnect.png" alt="" />
                <h2>Registration is off for now.</h2>
            </div>
        </div>
    </div>
    <?php else: ?>
    <style type="text/css">
        #image-preview {
            width: 200px;
            height: 200px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #ecf0f1;
        }

        .preview-img input {
            line-height: 200px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }

        .preview-img label {
            position: absolute;
            z-index: 5;
            opacity: 0.8;
            cursor: pointer;
            background-color: #bdc3c7;
            width: 200px;
            height: 50px;
            font-size: 20px;
            line-height: 50px;
            text-transform: uppercase;
            top: 145px;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            text-align: center;
        }

        .modal-backdrop {
            display: none;
        }

        .star {
            color: red;
            font-size: 22px;
        }

        .box-form {
            border: 2px solid #16A085;
            box-shadow: 0px 0px 12px 0px rgba(50, 50, 50, 0.75);
            padding-bottom: 50px;
        }

        .container {
            padding: 0px 0px;
        }

        .has-error .help-block {
            color: red;
            font-weight: bold;
            background: white;
        }

        .col-md-10.jscGrid input {
            float: right;
            margin-left: 2px;
            width: 152px;
        }

        .has-error .help-block {
            display: inline-block;
            float: right;
        }

        span.ci_error p {
            display: inline-block;
            color: orangered;
            width: 100%;
            text-align: right;
            font-weight: bold;
            margin: 0;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
            });
        });
    </script>


    <div class="container box-form">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-12">
                <?php echo flash_msg(); ?>
            </div>

            <div class="row text-center" style="padding: 30px 0px;">
                <div class="col-md-12">
                    <h2><?php echo $schoolName; ?></h2>
                    <h4>Online Admission Form</h4>
                    <h5>All Information have to fill in English, only 2, 4, 6 have to fill in Bangla. Fields marked with star(
                        <span
                            class="star">*</span>) are mandatory fields.</h5>
                    <h5>Only Fillup 9 & 10 No Fields if Students Father is Dead. Otherwise these fields should be empty. </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" action="<?php echo base('Home', 'admit_student') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label"> 1. Student Name [English Block Letter]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="name" placeholder="Student Name" value="<?php echo set_value('name'); ?>" data-validation="custom"
                                    data-validation-regexp="^([A-Za-z. ]+)$">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('name'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label"> 2. Student Name [বাংলায়]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control bangla" name="namebn" value="<?php echo set_value('namebn'); ?>" placeholder="শিক্ষার্থীর নাম বাংলায়"
                                    data-validation="required">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('namebn'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">3. Father's Name [English Block Letter]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="fname" placeholder="Fathers Name" value="<?php echo set_value('fname'); ?>"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('fname'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label"> 4. Father's Name [বাংলায়]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control bangla" name="fnamebn" value="<?php echo set_value('fnamebn'); ?>" placeholder="পিতার নাম বাংলায়"
                                    data-validation="required">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('fnamebn'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">5. Mother's Name [English Block Letter]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="mname" value="<?php echo set_value('mname'); ?>" placeholder="Mothers Name"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z. ]+)$">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('mname'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label"> 6. Mother's Name [বাংলায়]
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control bangla" name="mnamebn" value="<?php echo set_value('mnamebn'); ?>" placeholder="মাতার নাম বাংলায়"
                                    data-validation="required">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('mnamebn'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">7. Permanent Address
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="paadress" value="<?php echo set_value('paadress'); ?>" placeholder="Vill: Homna, PO: Homna, Upazila: Homna, Dist: Homna"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('paadress'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">8. Present Address
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="praddress" value="<?php echo set_value('praddress'); ?>" placeholder="Present Address"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('praddress'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">9. Legal Guardian Name</label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="lguaridan" placeholder="Legal Guardian Name">
                            </div>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">10. Relation With Guardian</label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="relaguardian" placeholder="Relation With Guardian">
                            </div>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">11. Religion
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">

                                <select class="form-control" name="religion">
                                    <option>Islam</option>
                                    <option>Hindu</option>
                                    <option>Chirstian</option>
                                    <option>Buddhist</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">12. Gender
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <select name="sex" class="form-control" id="">
                                    <option value="1">Boy</option>
                                    <option value="2">Girl</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">13. Nationality
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="nationality" placeholder="Nationality" value="Bangladeshi" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">14. Previous School Name
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="preschoolname" value="<?php echo set_value('preschoolname'); ?>" placeholder="Previous School Name"
                                    data-validation="required">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('preschoolname'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">15. Previous School Address
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="preschooladd" value="<?php echo set_value('preschooladd'); ?>" placeholder="Previous School Address"
                                    data-validation="custom" data-validation-regexp="^([A-Za-z0-9-/:,. ]+)$">
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('preschooladd'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">16. Email</label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">17. Want to Admit Class
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <!--<input type="text" class="form-control" placeholder="Want to Admit Class">-->
                                <select class="form-control" id="classID" name="class">
                                    <option>6</option>
                                    <option>7</option>
                                    <option>8</option>
                                    <option>9</option>
                                    <option value="91">9 Vocational</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group hrline hideDiv">
                            <label for="inputText3" class="control-label">A. Group
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <!--<input type="text" class="form-control" placeholder="Want to Admit Class">-->
                                <select class="form-control" name="group">
                                    <option value="business-studies">Business Studies</option>
                                    <option value="science">Science</option>
                                    <option value="humanities">Humanities</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group hrline hideDiv1">
                            <label for="inputText3" class="control-label">A. Group
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <!--<input type="text" class="form-control" placeholder="Want to Admit Class">-->
                                <select class="form-control" name="groups">
                                    <option value="electrical">Electrical</option>
                                    <option value="mechanical">Mechanical</option>
                                    <option value="dressMaking">Dress Making</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group hrline hideDiv2">
                            <label for="inputText3" class="control-label">B. JSC Info:
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-10 jscGrid" style="float: right">
                                <input type="text" class="form-control" name="jscinfo[]" placeholder="Year" data-validation="required" />
                                <input type="text" class="form-control" name="jscinfo[]" placeholder="Roll No." data-validation="required" />
                                <input type="text" class="form-control" name="jscinfo[]" placeholder="Reg. No." data-validation="required" />
                                <input type="text" class="form-control" name="jscinfo[]" placeholder="GPA" data-validation="required" />
                            </div>
                        </div>
                        <div class="form-group hrline">
                            <!-- Date input -->
                            <label for="inputText3 date" class="control-label">18. Date of Birth
                                <span class="star">*</span>
                            </label>

                            <div class="input-group col-md-8" style="float: right">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" name="date" data-date-format="yyyy-mm-dd" value="<?php echo set_value('date'); ?>"
                                    placeholder="YYYY-MM-DD" type="text" required="required" />
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('date'); ?>
                            </span>
                        </div>
                        <div class="form-group hrline">
                            <label for="inputText3" class="control-label">19. Guardian Mobile No
                                <span class="star">*</span>
                            </label>
                            <div class="col-md-8" style="float: right">
                                <input type="text" class="form-control" name="mobile" value="<?php echo set_value('mobile'); ?>" placeholder="Guardian Mobile No"
                                    data-validation="custom" data-validation-regexp="^([0-9]+)$" data-validation-error-msg="Input Only Accept 0 to 9"
                                />
                            </div>
                            <span class="ci_error">
                                <?php echo form_error('mobile'); ?>
                            </span>
                        </div>

                        <div class="form-group hrline preview-img">

                            <div id="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="img" id="image-upload" data-validation="dimension mime size required" data-validation-allowing="jpg, png, gif"
                                    data-validation-dimension="max300x300" data-validation-max-size="100kb" />
                            </div>
                            <p class="help-block ">Attach a Passport Size Picture. Max File Size 100KB & Max Resolution 300 x 300 px.
                                <span class="star">*</span>
                            </p>
                        </div>
                        <!--<div class="checkbox">
                              <label>
                                <input type="checkbox"> Check me out
                              </label>
                        </div>-->
                        <div class="form-group hrline">
                            <div class="text-center">
                                <input type="submit" value="Submit" class="btn btn-default" onclick="return confirm('Are you sure your all information currect?');return false;">
                            </div>
                        </div>
                    </form>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <br/>
    <?php endif; ?>


    <script type="text/javascript" src="assets/js/driver.phonetic.js"></script>
    <script type="text/javascript" src="assets/js/driver.unijoy.js"></script>
    <script type="text/javascript" src="assets/js/engine.js"></script>

    <script>
        $(document).ready(function () {
            $(".bangla").bnKb({
                'switchkey': 'y',
                'driver': unijoy
            });
            $('.hideDiv,.hideDiv1,.hideDiv2').hide();
        });

        $("#classID").change(function () {
            var selectValue = $("#classID option:selected").val();
            //alert(selectValue);
            if (selectValue === "9") {
                $('.hideDiv,.hideDiv2').show();
                $('.hideDiv1').hide();
            } else if (selectValue === "91") {
                $('.hideDiv1,.hideDiv2').show();
                $('.hideDiv').hide();
            } else {
                $('.hideDiv,.hideDiv1,.hideDiv2').hide();
            }
        });
    </script>