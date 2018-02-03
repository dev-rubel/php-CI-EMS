<?php $SCHOOLINFO = explode('+', $SCHNAME['header_title']); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo lng($SCHOOLINFO[0]); ?></a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo lng('User'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo lng('Profile'); ?></a></li>
                        <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> <?php echo lng('Settings'); ?></a></li>
                        <li><a href="<?php echo base('Dashboard', 'logout'); ?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> <?php echo lng('Logout'); ?></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> <?php echo lng('Language'); ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base('Dashboard', 'language' . '?id=en'); ?>"><img src="<?php echo base_url() . 'assets/images/en.png'; ?>" /> <?php echo lng('English'); ?></a></li>
                        <li><a href="<?php echo base('Dashboard', 'language' . '?id=bn'); ?>"><img src="<?php echo base_url() . 'assets/images/bn.png'; ?>" /> <?php echo lng('Bangla'); ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <ul class="nav menu">
        <li class="<?php if (isset($dash)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', ''); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i> <?php echo lng('Dashboard'); ?></a></li>
        <li class="parent ">
            <a href="#">
                <span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> <?php echo lng('header'); ?> 
            </a>
            <ul class="children collapse <?php if (isset($dropIn1)) {
    echo 'in';
} else {
    echo '';
} ?>" id="sub-item-1">
                <li class="<?php if (isset($logoA)) {
    echo 'active';
} else {
    echo '';
} ?>">
                    <a class="" href="<?php echo base('Dashboard', 'change_logo'); ?>">
                        <i class="fa fa-indent" aria-hidden="true"></i> <?php echo lng('Logo'); ?>
                    </a>
                </li>
                <li class="<?php if (isset($logoB)) {
    echo 'active';
} else {
    echo '';
} ?>">
                    <a class="" href="<?php echo base('Dashboard', 'school_name') ?>">
                        <i class="fa fa-graduation-cap" aria-hidden="true"></i> <?php echo lng('School Name'); ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php if (isset($socialA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'social_link') ?>"><i class="fa fa-share-square" aria-hidden="true"></i> <?php echo lng('Social Link'); ?></a></li>
        <li class="<?php if (isset($sliderA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'slider') ?>"><i class="fa fa-sliders" aria-hidden="true"></i> <?php echo lng('Slider'); ?></a></li>
        <li class="<?php if (isset($noticeA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'notice') ?>"><i class="fa fa-flag" aria-hidden="true"></i> <?php echo lng('Notice'); ?></a></li>
        <li class="parent ">
            <a href="#">
                <span data-toggle="collapse" href="#sub-item-2"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> <?php echo lng('Message'); ?> 
            </a>
            <ul class="children collapse <?php if (isset($dropIn2)) {
    echo 'in';
} else {
    echo '';
} ?>" id="sub-item-2">
                <li class="<?php if (isset($msg1A)) {
    echo 'active';
} else {
    echo '';
} ?>">
                    <a class="" href="<?php echo base('Dashboard', 'founder_message') ?>">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i> <?php echo lng('Founder message'); ?>
                    </a>
                </li>
                <li class="<?php if (isset($msg2A)) {
    echo 'active';
} else {
    echo '';
} ?>">
                    <a class="" href="<?php echo base('Dashboard', 'headmaster_message') ?>">
                        <i class="fa fa-commenting" aria-hidden="true"></i> <?php echo lng('Headmaster message'); ?>
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php if (isset($historyA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'school_history') ?>"><i class="fa fa-history" aria-hidden="true"></i> <?php echo lng('School History'); ?></a></li>
        <li class="<?php if (isset($linkA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'important_link') ?>"><i class="fa fa-link" aria-hidden="true"></i> <?php echo lng('Important Link'); ?></a></li>
        <li class="<?php if (isset($locationA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'location') ?>"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo lng('Location'); ?></a></li>
        <li class="<?php if (isset($presentA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'present') ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo lng('Student present'); ?></a></li>
        <li class="<?php if (isset($galleryA)) {
    echo 'active';
} else {
    echo '';
} ?>"><a href="<?php echo base('Dashboard', 'gallery') ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo lng('Image Gallery'); ?></a></li>
        <li role="presentation" class="divider"></li>
        <li><a href="<?php echo base('Home', ''); ?>" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> <?php echo lng('Home Page'); ?></a></li>
    </ul>

</div><!--/.sidebar-->;
;
