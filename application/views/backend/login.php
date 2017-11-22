<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo get_phrase('login'); ?> | <?php echo $system_title; ?></title>
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
       
        <style type="text/css">
            @font-face { font-family: 'Source Sans Pro'; src: url('assets/fonts/SourceSansPro-Regular.ttf'); } 
            * {
                margin: 0;
                padding: 0;
            }

            html {
                background: linear-gradient( limegreen, transparent ), linear-gradient( 90deg, skyblue, transparent ), linear-gradient( -90deg, coral, transparent );
            background-blend-mode: screen;
                background-size: cover;
                height: 700px;
            }

            body {
                background: transparent;
            }

            body, input, button {
                font-family: 'Source Sans Pro', sans-serif;
            }

            .login {
                padding: 15px;
                width: 400px;
                min-height: 400px;
                margin: 8% auto 0 auto;
            }
            .login .heading {
                text-align: center;
                margin-top: 1%;
                padding: 10px;
            box-shadow: 0 0 0 10px rgba(0,0,0,0.3);
            }
            .login .heading h2 {
                font-size: 3em;
                font-weight: 300;
                color: rgba(255, 255, 255, 0.7);
                display: inline-block;
                padding-bottom: 5px;
                text-shadow: 1px 1px 3px #23203b;
            }
            .login form .input-group {
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
            .login form .input-group:last-of-type {
                border-top: none;
            }
            .login form .input-group span {
                background: transparent;
                min-width: 53px;
                border: none;
            }
            .login form .input-group span i {
                font-size: 1.5em;
                color: #393437;
            }
            .login form input.form-control {
                display: block;
                width: auto;
                height: auto;
                border: none;
                outline: none;
                box-shadow: none;
                background: none;
                border-radius: 0px;
                padding: 10px;
                font-size: 1.6em;
                width: 100%;
                background: transparent;
                color: black;
            }
            .login form input.form-control:focus {
                border: none;
            }
            .login form button {
                margin-top: 20px;
            background: #1571BB;
            border: none;
            font-size: 1.6em;
            font-weight: 300;
            padding: 5px 0;
            width: 100%;
            border-radius: 3px;
            color: #b3eecc;
            border-bottom: 4px solid #393437;
            }
            .login form button:hover {
                background: #393437;
            -webkit-animation: hop 1s;
            animation: hop 1s;
            border-bottom: 4px solid #1571BB;
            }

            .float {
                display: inline-block;
                -webkit-transition-duration: 0.3s;
                transition-duration: 0.3s;
                -webkit-transition-property: transform;
                transition-property: transform;
                -webkit-transform: translateZ(0);
                transform: translateZ(0);
                box-shadow: 0 0 1px transparent;
            }

            .float:hover, .float:focus, .float:active {
                -webkit-transform: translateY(-3px);
                transform: translateY(-3px);
            }

            /* Large Devices, Wide Screens */
            @media only screen and (max-width: 1200px) {
                .login {
                    width: 600px;
                    font-size: 2em;
                }
            }
            @media only screen and (max-width: 1100px) {
                .login {
                    margin-top: 18%;
                    width: 600px;
                    font-size: 1.7em;
                }
            }
            /* Medium Devices, Desktops */
            @media only screen and (max-width: 992px) {
                .login {
                    margin-top: 20%;
                    width: 550px;
                    font-size: 1.7em;
                    min-height: 0;
                }
            }
            /* Small Devices, Tablets */
            @media only screen and (max-width: 768px) {
                .login {
                    margin-top: 0;
                    width: 500px;
                    font-size: 1.3em;
                    min-height: 0;
                }
            }
            /* Extra Small Devices, Phones */
            @media only screen and (max-width: 480px) {
                .login {
                    margin-top: 0;
                    width: 400px;
                    font-size: 1em;
                    min-height: 0;
                }
                .login h2 {
                    margin-top: 0;
                }
            }
            /* Custom, iPhone Retina */
            @media only screen and (max-width: 320px) {
                .login {
                    margin-top: 0;
                    width: 200px;
                    font-size: 0.7em;
                    min-height: 0;
                }
            }


        </style>
    </head>

    <body>
        <div class="login">
            <div class="heading">
                <div class="login-content" style="width:100%;">

                    <a href="<?php echo base_url(); ?>" class="logo">
                        <img src="uploads/logo.png" alt=""/>
                    </a>

                </div>
                <?php if(isset($_SESSION['loginsuccess'])):?>
                    <br/>
                    <h3 style="color: rgba(255, 255, 255, 0.2);"><?php echo $_SESSION['loginsuccess'];?></h3>
                    <br/>
                <?php else:?>
                    <h2 style="color: rgba(255, 255, 255, 0.2);">Sign in</h2><br/><br/>
                <?php endif;?>
                <form action="<?php echo base('login', 'ajax_login')?>" method="post">

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="email" class="form-control" placeholder="Username or email">
                    </div>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button type="submit" class="float">Login</button>
                </form><br/>
                <p><a href="<?php echo base('login', 'forgot_password')?>" style="color: rgba(255, 255, 255, 0.2);">Forgot Password..??</a></p>
            </div>
        </div>


    </body>
</html>
