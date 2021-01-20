<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('tomoney')) {
	function tomoney($number) {
		$chars=str_split($number);
		$str = "";
		echo 'plu';
		for($i=0;$i<count($chars);){
			for($a=0;$a<3;$a++,$i++){
				$str=$str.$chars[$i];
			}
			$str= $str." ";	
		}	
		return substr($str,0,count($str)-1);
	}
}
?>
