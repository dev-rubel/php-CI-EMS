<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="<?php echo base_url(); ?>" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Under Constraction">
    <meta name="author" content="NihalIt">
    <title><?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?></title>
    <!-- Bootstrap -->
    <link href="assets/underConstraction/css/bootstrap.css" rel="stylesheet">
    <link href="assets/underConstraction/css/bootstrap-theme.css" rel="stylesheet">
    <link href="assets/underConstraction/css/font-awesome.css" rel="stylesheet">
    <!-- siimple style -->
    <link href="assets/underConstraction/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div id="wrapper">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <a href="<?php echo base_url();?>index.php?login" target="_blank" class="login-link">Login</a>
            <h1><?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?></h1>
            <h2 class="subtitle">We're working hard to improve our website and we'll ready to launch before</h2>
            <div id="countdown"></div>
            <div class="social">
              <a href="https://www.facebook.com/NihalitHost/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="https://www.twitter.com/NihalITHost" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
              <a href="https://www.plus.google.com/+NihalITDhaka" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
              <a href="https://www.linkedin.com/company/nihal-it" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
            </div>
          </div>
          
        </div>
        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
            <p class="copyright">&copy; <a href="http://www.nihalit.com">NihalIt</a> - All Rights Reserved</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="assets/underConstraction/js/bootstrap.min.js"></script>
  <script src="assets/underConstraction/js/jquery.countdown.min.js"></script>
  <script type="text/javascript">
  
  $('#countdown').countdown("2017/11/03", function(event) {
  $(this).html(event.strftime('%w week %d days <br /> %H:%M:%S'));
  });
  </script>
  
</body>
</html>