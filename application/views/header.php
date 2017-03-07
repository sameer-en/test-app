<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expenses Tracking</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/jquery/jquery-ui.min.css')?>" rel="stylesheet">
     
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script >
        SITE_URL = "<?=site_url();?>/";
    </script>
    </head> 
<body>
  <header>
 
         <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="container-fluid">
                    <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="<?=site_url('/');?>"> Expenses Tracking</a>
                    </div>
                     <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                          <li class="<?php echo  ($active_menu =='' || $active_menu == 'home') ? 'active' : '' ;?>"><a href="<?=site_url('/');?>">Home</a></li>
                          <li class="dropdown <?php echo  ($active_menu == 'user') ? 'active' : '' ;?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Accounts Management
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?=base_url();?>index.php/users/index">List</a></li>
                              <li><a href="<?=base_url();?>index.php/users/create">Add</a></li>
                            </ul>
                          </li>
                          <li class="dropdown <?php echo  ($active_menu == 'cat') ? 'active' : '' ;?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Category Management
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                           <li><a href="<?=base_url();?>index.php/category/index">List</a></li>
                           <li><a href="<?=base_url();?>index.php/category/create">Add</a></li>
                            </ul>
                          </li>
                          <li class="dropdown <?php echo  ($active_menu == 'exp') ? 'active' : '' ;?>">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Expenses Management
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                           <li><a href="<?=base_url();?>index.php/exp/index">List</a></li>
                           <li><a href="<?=base_url();?>index.php/exp/create">Add</a></li>
                            </ul>
                          </li>
                          <!--  <li ><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                           <li ><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
                        </ul>
                         <ul class="nav navbar-nav navbar-right">
                              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                              <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        </ul>
                    </div>
              </div>
        </nav>
       
      </header> 
  <div class="container container-body">

