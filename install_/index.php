<?php 
/*
    add below condition at main index file of ci. so it will check and redirect to this install script..
*/
if ( file_exists(dirname(__FILE__)."/install") && !preg_match("/migrate\//",$_SERVER['PATH_INFO']) )
{
    header('location:install/');die;
}

/*--------------------------------------------- */
error_reporting(1);
$currFileName = basename(__FILE__);
// echo  '<pre>';print_r($_SERVER);die;
$baseURL = $_SERVER['HTTP_HOST'].str_replace('install/'.$currFileName,'',$_SERVER['SCRIPT_NAME']);


$strErrors = $strSuccess = "";
$arrMessages = $arrErrors = $arrSuccess = array();


$showForm = 1;
$install = 0;

// $strSuccess = 'Installation Started ...!!!<br/>Conncted to MySQL...<br/>Success Creating New Database...<br/>Generating Database Tables : Success...<br/>Installation finished ...!!!';

if(isset($_POST['btn_submit']))
{
    $host = $dbUser = $dbPass = $dbName = '';
    if(isset($_POST['host']) && $_POST['host'] !='')
    {
        $host = $_POST['host'] ;
    }

    if(isset($_POST['dbUser']) && $_POST['dbUser'] !='')
    {
        $dbUser = $_POST['dbUser'] ;
    }

    if(isset($_POST['dbPass']) && $_POST['dbPass'] !='')
    {
        $dbPass = $_POST['dbPass'] ;
    }

     if(isset($_POST['dbName']) && $_POST['dbName'] !='')
    {
        $dbName = $_POST['dbName'] ;
    }

    if($host !='' && $dbUser !='' &&  $dbName !='')
    {
        $arrMessages[] = ['info',"Installation Started !!!"];
        $arrReplace = [
                    '##HOSTNAME##' => $host,
                    '##DBUSER##' => $dbUser,
                    '##DBPASS##' => $dbPass,
                    '##DBNAME##' => $dbName,
                ];

        $arrLines = array();
        //update db file
        $fileName = dirname(dirname(__FILE__))."/application/config/database.php";
        $handle = @fopen($fileName, "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                foreach($arrReplace as $key=>$value)
                {
                    if(preg_match("/$key/",$buffer))
                        {
                            $buffer =  str_replace("$key",$value,$buffer);  
                        }
                }
                
                $arrLines[] =  $buffer;
            }
            if (!feof($handle)) {
                $arrMessages[] = ['danger', "Error: unexpected fgets() fail."];
            }
            fclose($handle);

            @file_put_contents($fileName, implode("",$arrLines));
        
            //db connect :
            $dbConn = mysqli_connect($host,$dbUser,$dbPass,'');
            /* check connection */
            if (mysqli_connect_errno()) {
                 $arrMessages[] = ['danger',"Connect failed: %s\n". mysqli_connect_error()];
            }
            else
            {
                $arrMessages[] = ['success',"Conncted to MySQL: Success"];
                $query = "CREATE DATABASE IF NOT EXISTS $dbName";
                 if(mysqli_query($dbConn, $query)){
                        $arrMessages[] = ['success',"Creating New Database: Success"];
                       // echo "http://".$baseURL."migrate/";die;
                        $strResult = file_get_contents("http://".$baseURL."migrate/");
                        // var_dump( $strResult );die;
                        $arrMessages[] = ['success',"Generating Database Tables: $strResult"];
                        $install = 1;
                        $showForm = 0;    
                    } else {
                          $arrMessages[] = ['danger',"Error:".mysqli_errno($dbConn)];
                         foreach(mysqli_error_list($dbConn) as $err)
                         {
                              $arrMessages[] = ['danger',"\t".$err];
                         }
                    }
            }
        }
        else
        {
            $arrMessages[] = ['danger',"Error in writing application/config/database.php file."];
        }
    }
    else
    {
         $arrMessages[] = ['danger',"Please enter Hostname, MySQL Username and Database name."];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Basic Installtion script designed for CodeIgniter 3 framework.">
    <meta name="author" content="Sameer Kodilkar">

    <title>Installation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Installation</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#about">About</a>
                    </li>
                    <li>
                        <a href="#help">Help</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Welcome to Installation Script...</h1>
                <p class="lead">Follow below steps in install and start using products.Just one step installation!!</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="panel panel-default">
                      <div class="panel-heading"><h4>Enter Database details to start installation:</h4></div>
                      <div class="panel-body">
                           <?php 
                        if($showForm == 1) {?>
                            <form name="frmInstall" id="frmInstall" method="POST">
                             <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                              <span class="input-group-addon" id="basic-addon1">Database Host <small>(Usually localhost)</small></span>
                                               <input type="text" class="form-control" placeholder="localhost" title="Enter database host name" width="100" name="host" id="host">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <div class="input-group">
                                                  <span class="input-group-addon" id="basic-addon1">Database Name</span>
                                                   <input type="text" class="form-control" placeholder="Enter database name you want to create for this installation" title="Enter database name you want to create for this installation" name="dbName" id="dbName">
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                              <span class="input-group-addon" id="basic-addon1">Database User <small>(MySQL Username)</small></span>
                                               <input type="text" class="form-control" placeholder="root" title="Enter MySQL User name" width="100" name="dbUser" id="dbUser">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                              <span class="input-group-addon" id="basic-addon1">MySQL Password <small>(MySQL user's password)</small></span>
                                               <input type="text" class="form-control" placeholder="" title="Enter MySQL Password" width="100" name="dbPass" id="dbPass">
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="row"> 
                                    <div class="col-md-6">   
                                        <button type="submit" class="btn btn-primary" name="btn_submit" id="btn_submit">Install</button>
                                    </div>
                             </div>
                            </form>
                        <?php } //showform
                       // else  {

                            if(count( $arrMessages) > 0)
                            {
                                echo  '<div class="row"><div class="col-md-12"><br/>  ';
                                foreach( $arrMessages as $msg)
                                {
                                    echo "<div class='alert alert-".$msg[0]."' role='alert'>".$msg[1]."</div>";
                                }
                                echo '</div></div>';
                            }
                            //   if($strErrors !='')
                            //     {
                            //         echo "<div class='alert alert-danger' role='alert'>$strErrors</div>";
                            //     }

                            //  # show log here...
                            // if($strSuccess !='')
                            // {
                            //      echo "<div class='alert alert-success' role='alert'><p>$strSuccess</p></div>";
                            // }
                            if($install == 1)
                            {
                                echo  '<div class="row"> 
                                        <div class="col-md-12">   
                                            <p>Your script is installed. Please remove install directory to start using product.</p>
                                        </div>
                                 </div>';
                             }
                        // } ?>
                      </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
