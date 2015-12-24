<?php include(URL_DOCUMENT_ROOT . 'application/view/admin/includes/header.php');?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Post
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User</a></li>
            <li class="active">List</li>
          </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <?php if($post['text'] != '')
                    {
                        ?>
                        
                        <div class="col-xs-12" >
                            <a href="/post/index?id=<?php echo $post['id'] ?>" class="col-xs-12">
                                <h4>TITLE : &nbsp;&nbsp;<?php echo $post['title'] ?></h4>
                            </a>
                            <div class="col-xs-12">
                                <h5>TEXT : &nbsp;&nbsp;<?php echo $post['text'] ?></h5>
                            </div>
                        </div>
                    <a href="/admin/delete_post?id=<?php echo $postID ?>" class="col-xs-12 btn btn-danger" style="margin-bottom: 10px">DELETE POST</a>
                    <?php
                    }
                    else if($post['url'] != '')
                    {
                        ?>
                        <div class="col-xs-12">
                            <a href="<?php echo $post['url'] ?>">URL : &nbsp;&nbsp; <?php echo $post['title'] ?></a>
                        </div>
                    <?php
                    }
                    ?>

                   
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
                <?php if($post['realised'] == 0)
                {
                  ?>
                <a href="/admin/post_close?id=<?php echo $post['id'] ?>" class='btn btn-danger col-xs-12' style='margin-bottom:20px'>CLOSE THIS POST</a>
                <?php
                }
                else if($post['realised'] == 1)
                {
                    echo '<div class="btn btn-danger col-xs-12" style="margin-bottom:20px">This post is closed</div>';
                }
                ?>
                
                <div class="col-xs-12">
                    
                    <?php 
                    $count = 1;
                    foreach($comments AS $comment)
                    {
                        ?>
                    
                   <div class="col-xs-12" style="min-height:30px">
                        
                        <a class="col-xs-10 pull-left"><?php echo $count++.')  '.$comment['comment']; ?></a>
                        
                            <a class="col-xs-2 btn btn-xs btn-danger pull-right " href="/admin/delete_comment?id=<?php echo $comment['id'] ?>">delete</a>
                        
                   </div>
                    
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    
<?php include(URL_DOCUMENT_ROOT . 'application/view/admin/includes/footer.php'); ?>