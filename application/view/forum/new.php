<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/header.php');?>
<script>
    $(document).ready(function(){
       $('#link-radio').click(function(){
           $('#text-div').hide();
           $('#text-field').attr('disabled','disabled');
           $('#url-div').show();
           $('#url-field').removeAttr('disabled');
       });
       
       $('#text-radio').click(function(){
           $('#text-div').show();
           $('#text-field').removeAttr('disabled');
           $('#url-div').hide();
           $('#url-field').attr('disabled','disabled');
       });
    });
    </script>
    <div class="container">
        <div class="row ">
        
        <div class="col-xs-12 register-form-margin">
            
            <div class="panel panel-default ">
                 
                <div class="panel-heading"> <strong class="">New Topic</strong>

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
                    <form action="/post/create" method='post' class='form-horizontal' role='form' enctype="multipart/form-data">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div>
                            <span class="url-text-radio"><input id="link-radio" type="radio" name="url-text-select" checked/><label>URL</label></span>
                            <span class="url-text-radio"><input id="text-radio" type="radio" name="url-text-select"/><label>Text</label></span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Image</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="file" name="image" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Title</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" name="data[title]" class="form-control " placeholder="Title" value='<?php if(isset($user['data']['title'])){echo $user['data']['title'];} ?>' />
                            </div>
                        </div>
                        <div class="form-group" id="text-div" style="display: none">
                            <label class="col-md-3 col-xs-12 control-label">Text(OPTIONAL)</label>
                            <div class="col-md-9 col-xs-12">
                                <textarea id="text-field" name="data[text]" class="form-control " placeholder="Text" disabled><?php if(isset($user['data']['text'])){echo $user['data']['text'];} ?></textarea>
                            </div>
                        </div>
                        <div class="form-group" id="url-div">
                            <label class="col-md-3 col-xs-12 control-label">URL</label>
                            <div class="col-md-9 col-xs-12">
                                <input type="text" id="url-field" name="data[url]" class="form-control " placeholder="URL" value='<?php if(isset($user['data']['url'])){echo $user['data']['url'];} ?>'/>
                            </div>
                        </div>
                        <div class="form-group" id="url-div">
                            <label class="col-md-3 col-xs-12 control-label">Type</label>
                            <div class="col-md-9 col-xs-12">
                                <select name="data[theory]" class="form-control ">
                                    <option value="0" <?php if(isset($user['data']['theory']) && $user['data']['theory'] == 0){echo 'selected';} ?>>General</option>
                                    <option value="1" <?php if(isset($user['data']['theory']) && $user['data']['theory'] == 1){echo 'selected';} ?>>Theory</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-md-9 col-xs-12">
                                <button type="submit" class="btn btn-success btn-sm">Create New</button>
                                
                                <button type="reset" class="btn btn-default btn-sm">Reset</button>
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

  
  
    <div>
    </div>
   
<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/footer.php'); ?>