<?php
function normalize_url($url){
	$url = mb_strtolower($url);
	$url = str_replace(array('á','é','í','ó','ú','ã','õ','â','ê','î','ô','û','à','è','ì','ò','ù','ç'), 
					   array('a','e','i','o','u','a','o','a','e','i','o','u','a','e','i','o','u','c'), 
					   $url);
	$url = preg_replace(array('/\s/', '/[\-]+/', '/[^a-zA-Z0-9\.\:\-\/]*/'), array('-', '-', ''), $url);
	return $url;
}
function dateTimeBr($date){
	$date = explode(' ', $date);
	$date[0] = explode('-', $date[0]);
	return "{$date[0][2]}/{$date[0][1]}/{$date[0][0]} {$date[1]}";
}
?>