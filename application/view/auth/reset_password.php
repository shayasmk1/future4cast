<!DOCTYPE html>
<html>
    <head>
        <title>
            Forgot Password
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
        <div class='col-xs-1'>
            
        </div>
        <div class="col-xs-10 login-form-margin">
           
            <div class="panel panel-default ">
                 
                <div class="panel-heading"> <strong class="">Reset Password</strong>

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
                    <form action='/auth/reset_password' method='post' class='form-horizontal' role='form'>
                   
                        <div class="form-group">
                            <label class="col-sm-4 col-xs-12 control-label">Please Enter your Current Password</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="password" name="data[current_password]" class="form-control " placeholder="Current Password" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 col-xs-12 control-label">Please Enter your New Password</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="password" name="data[password]" class="form-control " placeholder="New Password" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 col-xs-12 control-label">Confirm New Password</label>
                            <div class="col-sm-8 col-xs-12">
                                <input type="password" name="data[reenter_password]" class="form-control " placeholder="Re-enter Password" />
                            </div>
                        </div>
                        
                        <div class="form-group last">
                            <div class="col-sm-offset-4 col-sm-8 col-xs-12">
                                <input type="submit" value="Change Password" class = "btn btn-success btn-sm" />
                                <a href="/" class="btn btn-primary btn-sm">Home</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
                <div class="panel-footer">
<!--                    Not Registered? <a href="#" class="">Register here</a>-->
                </div>
            </div>
        </div>
        <div class='col-xs-1'>
            
        </div>
    </div>