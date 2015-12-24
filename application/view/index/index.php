<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/header.php');?>
<div class="container" style="min-width:0px">
        <?php foreach($posts AS $post)
        {
            ?>
            <div class="col-xs-12 well">
                <?php
                if($post['image'] == '')
                {
                    $url = 'img/samples.png';
                }
                else
                {
                    $url = 'img/posts/'.$post['image'];
                }
                ?>
                <div class="col-xs-2 image-area" style="background-image: url('<?php echo URL_PROTOCOL . $url ?>')">
                    
                </div>
                <div class="col-sm-8 col-xs-10">
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
<!--                    <div class="col-xs-12">
                        <?php echo $post['text'] ?>
                    </div>
                    <div class="col-xs-12">
                        <?php echo $post['description'] ?>
                    </div>-->
                </div>
                <div class="col-xs-12 col-sm-2 hcenter like-bottom" >
                    <span class='glyphicon glyphicon-arrow-up vote-up' data-id='<?php echo $post['id'] ?>' style='cursor: pointer' ></span>
                    <span class="votes"><?php echo $post['like_count'] ?></span>
                    
                    
                </div>
            </div>
        <?php
        }
        
        if(count($posts) >= 50)
        {
            ?>
    <button type="button" class="col-xs-12">LOAD MORE RESULTS</button>
    <?php
        }
        ?>
        
    </div>

  <div class="search--main">
   
    <div class="scroll-marker" data-search="scroll-marker">Casting More results...</div>
  </div>

  
    <div>
    </div>
   
<?php include(URL_DOCUMENT_ROOT . 'application/view/includes/footer.php'); ?>