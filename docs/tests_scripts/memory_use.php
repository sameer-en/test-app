	<?php

echo "Initial: ".number_format((memory_get_usage()/1024),2)." Kb <br/>";
/* prints
Initial: 361400 bytes
*/
 
// let's use up some memory
for ($i = 0; $i < 100000; $i++) {
    $array []= md5($i);
}
 
// let's remove half of the array
for ($i = 0; $i < 100000; $i++) {
    unset($array[$i]);
}
 
echo "Final: ".number_format((memory_get_usage()/1024),2)." bytes <br/>";
/* prints
Final: 885912 bytes
*/
 
echo "Peak: ".number_format((memory_get_peak_usage()/1024),2)." bytes <br/>";
/* prints
Peak: 13687072 bytes
*/
?>