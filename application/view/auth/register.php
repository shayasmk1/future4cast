<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/header.php');?>
    <div class='container'>
    <div class="row ">
        
        <div class="col-xs-12 register-form-margin">
            
            <div class="panel panel-default ">
                 
                <div class="panel-heading"> <strong class="" style="color:red">Register</strong>

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
                    <form action="/auth/register" method='post' class='form-horizontal' role='form'>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Full Name</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="data[name]" class="form-control " placeholder="Name" value='<?php if(isset($user['data']['name'])){echo $user['data']['name'];} ?>'/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="text" name="data[email]" class="form-control " placeholder="Email" value='<?php if(isset($user['data']['email'])){echo $user['data']['email'];} ?>'/>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Password</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="password" name="data[password]" class="form-control " placeholder="Password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 col-xs-12 control-label">Confirm Password</label>
                            <div class="col-sm-9 col-xs-12">
                                <input type="password" name="data[confirm_password]" class="form-control " placeholder="Confirm Password"/>
                            </div>
                        </div>
                        
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9 col-xs-12">
                                <button type="submit" class="btn btn-success btn-sm">Register</button>
                                
                                <button type="reset" class="btn btn-primary btn-sm">Reset</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="panel-footer">
<!--                    Not Registered? <a href="#" class="">Register here</a>-->
                </div>
            </div>
        </div>
       
    </div>
    </div>
<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/footer.php'); ?>