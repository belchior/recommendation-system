<?php
function normalize_url($url){
	$url = mb_strtolower($url);
	$url = str_replace(array('á','é','í','ó','ú','ã','õ','â','ê','î','ô','û','à','è','ì','ò','ù','ç'), 
					   array('a','e','i','o','u','a','o','a','e','i','o','u','a','e','i','o','u','c'), 
					   $url);
	$url = preg_replace(array('/\s/', '/[\-]+/', '/[^a-zA-Z0-9\.\:\-\/]*/'), array('-', '-', ''), $url);
	return $url;
}
?>