<?php


class A {
    public $foo = 1;
}  

$a = new A;
$b = $a;     // $a and $b are copies of the same identifier
             // ($a) = ($b) = <id>
$b->foo = 2;
echo $a->foo."<br/>";


$c = new A;
$d = &$c;    // $c and $d are references
             // ($c,$d) = <id>

$d->foo = 2;
echo $c->foo."<br/>";


$e = new A;

function foo($obj) {
    // ($obj) = ($e) = <id>
    $obj->foo = 2;
}

foo($e);
echo $e->foo."<br/>";


die;
function reverseString($str) {
  $newstr = '';
  
  for($i = (strlen($str)-1);$i >= 0; $i--)
    {
      $newstr .= $str[$i];
    }
  return $newstr;
}

echo reverseString("Hello World!");


?>