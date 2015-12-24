<!DOCTYPE html>
<html>
    <head>
        <title>
            Login
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo URL_PROTOCOL ?>css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL_PROTOCOL ?>bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL_PROTOCOL ?>datepicker/public/css/default.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo URL_PROTOCOL ?>img/fav.png" />
        <script type="text/javascript" src="<?php echo URL_PROTOCOL ?>js/jquery-1.11.2.min.js"></script>
        <script src="<?php echo URL_PROTOCOL ?>bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo URL_PROTOCOL ?>datepicker/public/javascript/zebra_datepicker.js"></script>
        <script type="text/javascript" src="<?php echo URL_PROTOCOL ?>js/script.js"></script>
        
    </head>
    <body class="grey-bg">
        <div class="container">
    <div class="row">
        <div class='col-sm-3 col-xs-1'>
            
        </div>
        <div class="col-sm-6 col-xs-10 login-form-margin">
           
            <div class="panel panel-default ">
                 
                <div class="panel-heading"> <strong class="">Login</strong>

                </div>
                <div class="panel-body">
                    <div class='error col-xs-12 '>
                        <label class="col-xs-12 control-label">
                            <?php if(isset($message))
                            {
                                echo $message;
                            }
                            ?>
                        </label>
                    </div>
                    <form action='/auth/login' method='post' class='form-horizontal' role='form'>
                   
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="data[email]" class="form-control " placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Password</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="password" name="data[password]" class="form-control " placeholder="Password" />
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-9">
                                <div class="checkbox">
                                    <label class="">
                                        <input class="" type="checkbox" name='remember'>Remember me</label>
                                </div>
                            </div>
                        </div>-->
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9 col-xs-12">
                                <input type="submit" value="Sign in" class = "btn btn-success btn-sm" />
                                <button type="reset" class="btn btn-default btn-sm">Reset</button>
                                <br/><a href="/auth/forgot_password">Forgot Password? Click here</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div class="panel-footer">
<!--                    Not Registered? <a href="#" class="">Register here</a>-->
                </div>
            </div>
        </div>
        <div class='col-xs-1 col-sm-3'>
            
        </div>
    </div>
</div>
    </body>
</html>