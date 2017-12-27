<?php 
header("Content-type: text/css; charset: UTF-8"); 

$dir = explode('\\', __DIR__);
end($dir);
$last = key($dir);
unset($dir[$last]);
$dir = implode('\\', $dir);

$color = file_get_contents($dir.'\assets\siteColor.txt');
list($mainColor, $hoverColor) = explode('|', $color);

?>

body {
	font-family: 'SolaimanLipi' !important;
}

.main-menu a:hover {
	background-color: <?php echo $hoverColor; ?>
}

.hvr-bounce-to-right:before {
	background: <?php echo $hoverColor; ?>
}

.main-menu li ul {
	background-color: <?php echo $mainColor; ?>
}

.main-menu li ul li a:hover {
	background-color: <?php echo $hoverColor; ?>
}

.main-navigation, .site-footer {
	background-color: <?php echo $mainColor; ?>
}

.flex-direction-nav a {
	background-color: <?php echo $mainColor; ?>
}

.search-form form input, .main-navigation, .main-menu li {
	border-color: <?php echo $hoverColor; ?>
}

.main-menu li ul li {
	border-color: <?php echo $hoverColor; ?>
}

.latest_news:before {
	background-color: <?php echo $mainColor; ?>
	border-top: 1px solid <?php echo $hoverColor; ?>
}

.latest_news {
	background: <?php echo $hoverColor;?> !important;
}

.owl-carousel img {
	border: 2px solid <?php echo $mainColor; ?>
}

.panel-default {
	border-color: <?php echo $mainColor; ?>;
	background: <?php echo $mainColor; ?>
}

.Pagefooter {
	border: 2px solid <?php echo $mainColor; ?>;
	background-color: <?php echo $mainColor; ?>
}

.footer-media-icons li a {
	background-color: <?php echo $hoverColor; ?>
}

.col-md-4.datetime-section {
	background: <?php echo $mainColor; ?>!important;
}

.panel-default {
	border: 1px solid <?php echo $hoverColor; ?> !important;
}

.home-gallery.item img {
	border: 2px solid <?php echo $hoverColor; ?>!important;
}

.stat i {
	color: <?php echo $mainColor; ?> !important;
}


.Pagehead {
	background-color: white;
	box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 18.75);
	color: #16A085;
	/*background: url(http://turbo.designwoop.com/uploads/2012/10/subtle_background_textures_05-580x308.jpg);*/
}

.Pagehead a {
	color: #16A085;
}

.school-head h3 {
	margin-top: 0px;
	color: #16A085;
}

.bkchange {
	background: red;
}

li.blinks {
	border: 1px solid;
	padding: 2px;
	border-radius: 2px;
	background: <?php echo $hoverColor; ?>;
}

li.blinks a {
	color: white;
}

li.blinks:hover {
	background: white;
	border-radius: 2px;
	transition: 1s;
}

li.blinks a:hover {
	color: #16A085;
}

.latest_news:before {
	content: "গুরুত্বপূর্ন নোটিস";
	position: absolute;
	display: inline-block;
	padding: 2px;
	z-index: 999;
	font-weight: bold;
	color: white;
	padding-left: 15px;
	padding-right: 15px;
	padding-top: 8px;
	height: 40px;
	margin-left: -15px;
	border-top: 1px solid <?php echo $hoverColor; ?>;
	background: <?php echo $mainColor; ?>
}

.latest_news a {
	color: white;
	font-size: 16px;
}

.latest_news a:hover {
	color: black;
}

.col-md-4.datetime-section {
	height: 40px;
	text-align: center;
	padding-top: 8px;
	font-size: 15px;
	background: <?php echo $mainColor; ?>;
	color: white;
	border-left: 1px solid;
	border-top: 1px solid <?php echo $hoverColor; ?>;
}

.Pagefooter{
	box-shadow: 0px 0px 19px 0px rgba(0,0,0,18.75);
	color: white;
}
.Pagefooter a{
	color: white;
	
}  