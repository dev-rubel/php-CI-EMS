<div class="row">
	<div class="col-md-12 col-sm-12 clearfix" style="text-align:center;">
		<h2 style="font-weight:200; margin:0px; font-family: 'Lobster', cursive;"><?php echo $system_name;?></h2>
    </div>

	<div id="overlayDiv" style="width: 99%;height: 100%;background-color: white;position: absolute;top: 0;z-index: 11; opacity: .7; display: none;"></div>
	<img src="<?php echo base_url();?>assets/backend/loader.gif" id="loading" style="position: absolute; top: 50%; left: 40%; z-index: 1111; display: none;"/>  
	<img src="<?php echo base_url();?>assets/backend/loader.gif" id="loading2" style="position: absolute; top: 20%; left: 40%; z-index: 1111; display: none;"/>  

	<!-- Raw Links -->
	<div class="col-md-12 col-sm-12 clearfix ">
		
        <ul class="list-inline links-list pull-left">
        <!-- Language Selector -->
        	<div id="session_static">			
	           <li>
	           		<h4>
	           			<a href="#" style="color: #696969;"
	           				<?php if($account_type == 'admin'):?> 
	           				onclick="get_session_changer()"
	           			<?php endif;?>>
	           				<?php echo get_phrase('running_session');?> : <?php echo substr($running_year, 0, -5);?>
	           			</a>
	           		</h4>
	           </li>
           </div>
        </ul>
        
        
		<ul class="list-inline links-list pull-right">
		
		<li>
                        <a href="<?php echo base_url();?>" target="_blank">
					Homepage <i class="fa fa-home"></i>
				</a>
			</li>
		<li class="dropdown language-selector">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                        	<i class="entypo-user"></i> <?php echo $this->session->userdata('login_type');?>
                    </a>

				<?php if ($account_type != 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php?<?php echo $account_type;?>/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
				<?php if ($account_type == 'parent'):?>
				<ul class="dropdown-menu <?php if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
					<li>
						<a href="<?php echo base_url();?>index.php?parents/manage_profile">
                        	<i class="entypo-info"></i>
							<span><?php echo get_phrase('edit_profile');?></span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url();?>index.php?parents/manage_profile">
                        	<i class="entypo-key"></i>
							<span><?php echo get_phrase('change_password');?></span>
						</a>
					</li>
				</ul>
				<?php endif;?>
			</li>
			
			<li>
				<a href="<?php echo base_url();?>index.php?login/logout">
					Log Out <i class="entypo-logout right"></i>
				</a>
			</li>
		</ul>
	</div>
	
</div>

<hr style="margin-top:0px;" />

<script type="text/javascript">
	function get_session_changer()
	{
		$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_session_changer/',
            success: function(response)
            {
                jQuery('#session_static').html(response);
            }
        });
	}
</script>