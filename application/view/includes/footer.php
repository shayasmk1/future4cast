<div class="col-xs-12"  style="position: fixed;text-align: center;background-color :#F5F5F5;bottom:0px;padding:10px">
    Copyright : future4cast.  Powered by <a href="http://clusterinfos.com" target="_blank">ClusterInfos</a>
</div>
<!-- Modal -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action='/auth/login' method='post' class='form-horizontal' role='form'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Login</h4>
      </div>
      <div class="modal-body">
        
                   
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Email</label>
                            <div class="col-xs-9">
                                <input type="text" name="data[email]" class="form-control " placeholder="Email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Password</label>
                            <div class="col-xs-9">
                                <input type="password" name="data[password]" class="form-control " placeholder="Password" />
                            </div>
                        </div>
      </div>
      <div class="modal-footer">
            <div class="pull-left">
                <a href="/auth/register" class="btn btn-danger">Register</a>
            </div>
         
            <button type="submit" class="btn btn-success" >Sign In</button>
            <br/>
             <a style="margin-top:10px" href="/auth/forgot_password">Forgot Password? Click here</a>
      </div>
             </form>
    </div>
  </div>
</div>
    </body>
</html>