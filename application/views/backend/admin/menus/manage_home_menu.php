<style>
.panel-stat3 h2,h4{
    color: #fff;
}
</style>

<br>
<br>
<?php 
$links = ['social_link','slider','important_notice','notice','manage_pages','important_link','location','present','gallery'];
$title = ['Social Link','Slider','Important Notice', 'Regular Notice','Manage Pages','Important Links','Location','Present Page','Gallery'];
$color = ['bg-info','bg-primary','bg-sms','bg-today-app','bg-confirm-app','bg-padding-app','input-group-addon'];
 ?>
<div class="row">

<?php foreach($links as $k=>$each):?>
    <div class="col-sm-6 col-md-3" style="margin-bottom: 10px;">
        <a href="<?php echo base_url(); ?>index.php?homemanage/<?php echo $each?>">
            <div class="panel-stat3 bg-info<?php //echo $color[rand(1,7)];?>">
                <h2 class="m-top-none" id="userCount"><?php echo $k+1;?></h2>
                <h4><?php echo $title[$k];?></h4>

                <div class="stat-icon">
                    <i class="fa fa-bars fa-3x"></i>
                </div>
            </div>
        </a>
    </div>
    <!-- /.col -->
<?php endforeach;?>
</div>