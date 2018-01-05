<?php

include "config.php";

$url = "https://affiliate.gearbest.com/api/";
$time = time();



function getCompletedOrders() { 
global $api_secret, $api_key, $currency, $lkid, $page, $time;
$sign = strtoupper(md5($api_secret."api_key".$api_key."currency".$currency."lkid".$lkid."page". $page."time".$time.$api_secret));

$url_1 = $url."products/list-promotion-products?api_key=".$api_key."&time=".$time."&lkid=".$lkid."&currency=".$currency."&page=".$page."&sign=".$sign;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL, $url_1);
$output = curl_exec($ch);
curl_close($ch);
return $output; 
}