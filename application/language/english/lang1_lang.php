<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//php languages 
$CI =& get_instance();
$CI->load->database();

$query = $CI->db->query('select * from lang_vars where lang_id=1');
if($query->num_rows() > 0)
{
	foreach($query->result() as $data)
	{
		$lang[$data->lbl] = $data->msg;
		//echo '<pre>';print_r($data);die;
	}
}


//$lang['custom_lbl'] = 'Custom message!!!';
/*
for($i=1;$i<=50;$i++)
{
	$lang['custom_lbl'.$i] = 'Custom message!!!' .$i ;
}*/

/*$lang['custom_lbl1'] = 'Custom message!!!';
$lang['custom_lbl2'] = 'Custom message!!!';
$lang['custom_lbl3'] = 'Custom message!!!';
$lang['custom_lbl4'] = 'Custom message!!!';
$lang['custom_lbl5'] = 'Custom message!!!';
$lang['custom_lbl6'] = 'Custom message!!!';
$lang['custom_lbl7'] = 'Custom message!!!';
$lang['custom_lbl8'] = 'Custom message!!!';
$lang['custom_lbl9'] = 'Custom message!!!';
$lang['custom_lbl10'] = 'Custom message!!!';
$lang['custom_lbl11'] = 'Custom message!!!';
$lang['custom_lbl12'] = 'Custom message!!!';
$lang['custom_lbl13'] = 'Custom message!!!';
$lang['custom_lbl15'] = 'Custom message!!!';
$lang['custom_lbl14'] = 'Custom message!!!';
$lang['custom_lbl16'] = 'Custom message!!!';
$lang['custom_lbl17'] = 'Custom message!!!';
$lang['custom_lbl18'] = 'Custom message!!!';
$lang['custom_lbl19'] = 'Custom message!!!';
$lang['custom_lbl20'] = 'Custom message!!!';
$lang['custom_lbl21'] = 'Custom message!!!';
$lang['custom_lbl22'] = 'Custom message!!!';
$lang['custom_lbl23'] = 'Custom message!!!';
$lang['custom_lbl24'] = 'Custom message!!!';
$lang['custom_lbl25'] = 'Custom message!!!';
$lang['custom_lbl26'] = 'Custom message!!!';
$lang['custom_lbl27'] = 'Custom message!!!';
$lang['custom_lbl28'] = 'Custom message!!!';
$lang['custom_lbl29'] = 'Custom message!!!';
$lang['custom_lbl30'] = 'Custom message!!!';
$lang['custom_lbl31'] = 'Custom message!!!';
$lang['custom_lbl32'] = 'Custom message!!!';
*/

?>