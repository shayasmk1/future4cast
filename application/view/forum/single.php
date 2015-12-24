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
        
        <div class="col-xs-12 well">
                <div class="col-xs-1 image-area" style="background-image: url('<?php echo URL_PROTOCOL ?>img/samples.png')">
                    
                </div>
                <div class="col-xs-9 col-xs-8">
                    <?php if($post['text'] != '')
                    {
                        ?>
                        
                        <div class="col-xs-12">
                            <a href="/post/index?id=<?php echo $post['id'] ?>" class="col-xs-12">
                                <h5><?php echo $post['title'] ?></h5>
                            </a>
                            <div class="col-xs-12">
                                <h6><?php echo $post['text'] ?></h6>
                            </div>
                        </div>
                    <?php
                    }
                    else if($post['url'] != '')
                    {
                        ?>
                        <div class="col-xs-12">
                            <a href="<?php echo $post['url'] ?>"><?php echo $post['title'] ?></a>
                        </div>
                    <?php
                    }
                    ?>

                   
                </div>
                <div class="col-xs-2">
                    <span class='glyphicon glyphicon-arrow-up vote-up' data-id='<?php echo $post['id'] ?>' style='cursor: pointer' ></span>
                    <span class="votes"><?php echo $likes[0]['like_count'] ?></span>
                </div>
            </div>
            <div class="col-xs-12 well">
                <?php
                if(isset($_GET['message']))
                {
                    ?>
                <div style="color:red">
                    <?php echo $_GET['message'] ?>
                </div>
                <?php
                }
               
                ?>
                <?php if($post['user_id'] == $_SESSION['user'] && $post['realised'] == 0)
                {
                  ?>
                <a href="/post/close?id=<?php echo $post['id'] ?>" class='btn btn-danger col-xs-12' style='margin-bottom:20px'>CLOSE</a>
                <?php
                }
                else if($post['realised'] == 1)
                {
                    echo '<div class="btn btn-danger col-xs-12" style="margin-bottom:20px">This post is closed</div>';
                }
                ?>
                <?php
                if($post['realised'] == 0)
                {
                ?>
                <form method="POST" action="<?php echo URL_PROTOCOL ?>post/comment?id=<?php echo $postID ?>">
                    <input class="col-xs-12 form-control" type="text" name="data[comment]" placeholder="POST YOUR COMMENT" />
                    <button type="submit" class="btn btn-success col-xs-12" style="margin-top:10px">SUBMIT</button>
                </form>
                <?php
                }
                ?>
                <ul class="col-xs-12" style="margin-top:10px">
                    <?php foreach($comments AS $comment)
                    {
                        ?>
                    
                    <li>
                        <?php echo $comment['comment']; ?>
                    </li>
                    
                    <?php
                    }
                    ?>
                </ul>
                
                
            </div>
       
    </div>
        
    </div>

  
  
    <div>
    </div>
   
<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/footer.php'); ?>