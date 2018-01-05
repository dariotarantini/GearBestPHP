<?php

include "config.php";

$time = time();

function curlRequest($method, $args)
{
	$c = curl_init();
  curl_setopt($c, CURLOPT_HEADER, 0);
	curl_setopt($c, CURLOPT_URL, "https://affiliate.gearbest.com/api/products/" . $method . "?" . $args);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$r = curl_exec($c);
	curl_close($c);
	return $r;
}


function getCompletedOrders()
{ 
  global $config;
	$str = "";
	$args = "";
	
	ksort($config);
	foreach ($config as $key => $val)
	{
		$str = $str . $key . $val;
	}
  $sign = strtoupper(md5($api_secret . $str . $api_secret));
	
  $args = "api_key=".$api_key."&time=".$time."&lkid=".$lkid."&currency=".$currency."&page=".$page."&sign=".$sign;

  return curlRequest("list-promotion-products", $args);
}
