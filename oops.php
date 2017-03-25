<?php 

//oops class experiments
class parentClass
{
	var $var1 = array();
	var $commands = array();

	function __construct()
	{
		$this->var1 = "Initial value from parent";
	}

	public function prints()
	{
		echo "In print function";
		 //print_r($this->commands);die;
		$i = 0;
		foreach($this->commands as $command)
		{
			echo '<pre>';

			$functionName = $command[0];
			$params = array();
			 //var_Dump($command[1]);//die;
			call_user_func_array (array($this,$functionName),$command[1]);
		}
	}

	public function a($param1,$param2)
	{
	/*	print_r($param1);
		print_r($param2);//die;*/
		echo "<br/> IN function a<br/> $param1<br/>  $param2";
	}
	
	public function b($param1,$param2)
	{
		// print_r($param1);//die;
		// print_r($param2);//die;
		echo "<br/> IN function b<br/> $param1<br/>  $param2";
	}
	
	public function c($param1,$p3)
	{
		/*print_r($p3);//die;
		print_r($param1);//die;*/
		echo "<br/> IN function c<br/> $param1 <br/> $p3";
	}

}


class childClass extends parentClass
{
	
	function __construct()
	{
		$this->var1 = "Value set in chils";
	}

	function prints()
	{
		echo "<br/> In childs prints function<br/>";
		$this->commands = [
					array('a',['params','54asdsd']),
					array('b',['params',13131]),
					array('c',['params3211','sdf']),
				];
		parent::prints();
	}
}



$obj = new childClass();
$obj->prints();
?>