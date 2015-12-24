
<!DOCTYPE html>
<html>
<head>
  

  <title>Future4Cast</title>
  <link rel="canonical" href="" /><meta name="description" content="Future4Cast highlights your visions of our future. Post your ideas, thoughts, imaginations of what our distant lives will be like; be it musings, sketches, writings to actual blueprints, project models and even prototypes. Be it how we will live, how technology will change and how we will be affected." />
  

  <link rel="stylesheet" media="all" href="<?php echo URL_PROTOCOL ?>css/1.css" />
  <link rel="stylesheet" media="all" href="<?php echo URL_PROTOCOL ?>css/style.css" />
  <link rel="stylesheet" media="all" href="<?php echo URL_PROTOCOL ?>bootstrap/css/bootstrap.min.css" />
  <link href="<?php echo URL_PROTOCOL ?>datepicker/public/css/default.css" rel="stylesheet" type="text/css" />
<!--  <script src="<?php echo URL_PROTOCOL ?>js/main.js"></script>-->
<!--  <script src="<?php echo URL_PROTOCOL ?>js/legacy.js"></script>-->
   
  <script src="<?php echo URL_PROTOCOL ?>js/jquery-1.11.2.min.js"></script>
  <script src="<?php echo URL_PROTOCOL ?>bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo URL_PROTOCOL ?>datepicker/public/javascript/zebra_datepicker.js"></script>
    <script type="text/javascript" src="<?php echo URL_PROTOCOL ?>js/script.js"></script>  
 
  


  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo URL_PROTOCOL ?>img/fav.png" />
  <link rel="apple-touch-icon-precomposed" href="//assets.producthunt.com/assets/ph-ios-icon-f989a27d98b173973ce47298cb86cc0c.png">
  <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/likjafohlgffamccflcidmedfongmkee">
 
  <style>
      .search--main, .scroll-marker{
          display : block !important;
      }
  </style>

</head>

<body class="categories-posts-index m-user-is-not-invited-yet m-user-settings--thumbnails-enabled" data-component="LazyLoadContainer,FollowButtonsContainer,PopoverContainer,Search">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header ">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand col-xs-4 hidden-sm hidden-md hidden-lg" href="/">
            <img src="<?php echo URL_PROTOCOL ?>img/logo.png" alt="logo" class="col-xs-12" />
           
    </a>
    </div>
    <a class="navbar-brand col-md-2 col-sm-2 hidden-xs" href="/">
            <img src="<?php echo URL_PROTOCOL ?>img/logo.png" alt="logo" class="col-xs-12" />
           
    </a>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<!--      <form class="navbar-form navbar-left col-xs-6" role="search" method="post" action="/home/search" style="text-align:center;width:40% !important">
        
          <div id="custom-search-input">
                            <div class="input-group col-xs-12">
                                <input type="text" class="  search-query form-control" name="search" placeholder="Search for Castings" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
            
        <button type="submit" class="btn btn-default" style="display:none">Submit</button>
      </form>-->
      <form class="navbar-form navbar-left form-search-container" id="header-form" role="search" method="post" action="/home/search">
            <div id="custom-search-input">
                <div class="input-group col-xs-12">
                    <input type="text" class="  search-query form-control" name="search" placeholder="Search for Castings" />
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="button">
                            <span class=" glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
          <!--        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
        </div>-->
<!--        <button type="submit" class="btn btn-default">Submit</button>-->
      </form>
      
      <ul class="nav navbar-nav navbar-right ">
          
          <?php if(isset($_SESSION["user"]) && $_SESSION["user"] != '' && $_SESSION["user"] != 0)
                {
                    ?>
                <li>
                    <a href="/post/create" id="new_forum" >NEW TOPIC <span>+</span></a>
                </li>
                <li class="active welcome-box">
                    <a>
                  <?php  echo "Welcome ".$_SESSION["name"];  ?>
                    
                    </a>
                </li>
<?php                   
                }
                else
                {
                ?>
                    <li class="active"><a data-toggle="modal" data-target="#loginModal" style="cursor:pointer">User Log IN <span class="sr-only">(current)</span></a></li>
                <?php 
                
                } 
                ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More... <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php if(isset($_SESSION["user"]) && $_SESSION["user"] != '' && $_SESSION["user"] != 0) 
                { 
                    ?>
                <li><a href="/auth/reset_password">Reset Password</a></li>
                <?php
                }
                ?>
                <li role="separator" class="divider"></li>
                <li><a href="/about">About</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/faq">FAQ</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="/contact">Contact US</a></li>
                <li role="separator" class="divider"></li>
                <?php if(isset($_SESSION["user"]) && $_SESSION["user"] != '' && $_SESSION["user"] != 0) 
                { 
                    ?>
                    <li><a id="logout" style="cursor:pointer">LOGOUT</a></li>
                <?php 
                
                }
                ?>
              </ul>
            </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <header class="legacy-header">
    <div>
      

        <div class="header--secondary v-links">
          <div class="container">
            <a class="header--secondary--link v-category-tech <?php if($current == 'latest'){ echo 'm-active';} ?>" href="/forum/latest">New</a>
            <a class="header--secondary--link v-category-tech <?php if($current == 'trending'){ echo 'm-active';} ?>" href="/forum/trending">
                  Trending
            </a>                
            <a class="header--secondary--link v-category-tech <?php if($current == 'realised'){ echo 'm-active';} ?>" href="/forum/realised">
                  Realised
                  
            </a>
            <a class="header--secondary--link v-category-tech <?php if($current == 'theories'){ echo 'm-active';} ?>" href="/forum/theories">Theories</a>

            <a class="header--secondary--link v-category-tech <?php if($current == 'featured'){ echo 'm-active';} ?>" href="/forum/featured">Featured</a>

              
          </div>
        </div>
    </div>
  </header>