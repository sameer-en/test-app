<?php 
error_reporting(1);

//print_r($_SERVER);//die;
$baseURL = $_SERVER['HTTP_HOST'].str_replace('install/index.php','',$_SERVER['REQUEST_URI']);

// $_POST['host'] = 'localhost';
// $_POST['dbUser'] = 'tuser';


if($_POST)
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


	if($host !='' && $dbUser !='')
	{
		
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
		        echo "Error: unexpected fgets() fail\n";
		    }
		    fclose($handle);
		}
		@file_put_contents($fileName, implode("",$arrLines));

		//db connect :
		$dbConn = mysqli_connect($host,$dbUser,$dbPass,'');
		/* check connection */
		if (mysqli_connect_errno()) {
		    printf("Connect failed: %s\n", mysqli_connect_error());
		    exit();
		}
		else
		{
			echo "Conncted to MySQL<br/>";
			$dbName = 'db_install';
			$query = "CREATE DATABASE IF NOT EXISTS $dbName";
			 if(mysqli_query($dbConn, $query)){
			        echo "Success Creating New Database<br/>";
			        //echo $baseURL."migrate/";die;
			        $strResult = file_get_contents("http://".$baseURL."migrate/");
					echo "Generating Database Tables : ".$strResult;
					die;
			    } else {
			        echo "Failure:".mysqli_errno($dbConn );
			         print_r(mysqli_error_list($dbConn));
			        die;
			    }
		}
	
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CI- Install script</title>
</head>
<body>
<h1>Welcome to Installation script...</h1>
<?php 
if($strErrors !='')
{
	echo "<div>$strErrors</div>";
}
if($showForm == 1) {?>
	<form>
		

	</form>
<?php } //showform ?>

</body>
</html>