<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('date');
$this->load->helper('directory');


?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
		<p>
		<?php 

/*$post_date = time() - 99999999;
$now = time();
$units = 2;
echo "<p>".timespan($post_date, $now, $units)."</p>";*/

$map = directory_map('./assets/', FALSE, TRUE);
echo "<p><pre>";print_r($map);echo "</pre></p>";


		echo $this->lang->line('custom_lbl1');?>
		</p>
	</div>
	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<script>
	/*var script = document.createElement('script');
	script.onload = function() {
  		alert("Script loaded and ready");
	};
	script.src = "http://localhost/exp/assets/js/exp_add.js";
	document.getElementsByTagName('head')[0].appendChild(script);


	var script = document.createElement('script');
	script.onload = function() {
  		alert("Script loaded and ready");
	};
	script.src = "http://localhost/exp/assets/js/exp_list.js";
	document.getElementsByTagName('head')[0].appendChild(script);*/

</script>
<script src="//localhost/exp/assets/jquery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
SITE_URL = "//localhost/exp/";
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://");//www.

$(function(){
	alert("Jquery loaded!!!");

});

var script = document.createElement('script');
script.src = gaJsHost+"localhost/exp/assets/js/common.js";
document.getElementsByTagName('head')[0].appendChild(script);


//document.write(unescape("%3Cscript src='" + gaJsHost + "localhost/exp/assets/jquery/jquery-2.2.3.min.js' type='text/javascript'%3E%3C/script%3E"));
document.write(unescape("%3Cscript src='" + gaJsHost + "localhost/exp/assets/js/exp_list.js' type='text/javascript'%3E%3C/script%3E"));
document.write(unescape("%3Cscript src='" + gaJsHost + "localhost/exp/assets/js/exp_add.js' type='text/javascript'%3E%3C/script%3E"));


</script>
<script>
	
$(function(){
	samu();
});
</script>


</body>
</html>