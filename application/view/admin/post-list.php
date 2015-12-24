<?php include(URL_DOCUMENT_ROOT . 'application/view/admin/includes/header.php');?>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Post List
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Post</a></li>
            <li class="active">List</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            
            <?php
            if(isset($_GET['message']))
            {
                echo '<div style="color:red">'.$_GET['message'].'</div>';
            }
            ?>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Description
                            </th>
                            
                            <th>
                               Featured?
                            </th>
                            
                            <th>
                               Show
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($posts AS $post)
                        {
                            ?>
                        <tr>
                            <td>
                                <?php echo $post['title']; ?>
                            </td>
                            <td>
                                <?php if($post['text'] != '')
                                {
                                    echo $post['text'];
                                }
                                else
                                {
                                    echo $post['url'];
                                }
                            ?>
                            </td>
                           
                            <td>
                                <?php if($post['featured'] == 0)
                                {
                                    ?>
                                
                                <a href="/admin/make_featured?id=<?php echo $post['id'] ?>" class="btn btn-xs btn-success">Make it Feaured</a>
                            <?php
                                }
                                else {
                                    echo 'Featured';
                                }
                                ?>
                            </td>
                            
                            <td>
                                <a class="btn btn-xs btn-success" href="/admin/show_post?id=<?php echo $post['id'] ?>" />SHOW</a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include(URL_DOCUMENT_ROOT . 'application/view/admin/includes/footer.php'); ?>