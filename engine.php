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
  global $api_secret, $api_key, $currency, $lkid, $page, $time;

  $sign = strtoupper(md5($api_secret."api_key".$api_key."currency".$currency."lkid".$lkid."page". $page."time".$time.$api_secret));
  $args = "api_key=".$api_key."&time=".$time."&lkid=".$lkid."&currency=".$currency."&page=".$page."&sign=".$sign;

  return curlRequest("list-promotion-products", $args);
}
