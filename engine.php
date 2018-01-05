<?php
$file = file_get_contents("./config.json");
$config = json_decode($file, true);
$config['time'] = time();

function curlRequest($method, $args)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_HEADER, 0);
    curl_setopt($c, CURLOPT_URL, "https://affiliate.gearbest.com/api/products/" . $method . "?" . $args);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    $r = curl_exec($c);
    curl_close($c);
    return json_decode($r);
}

function getCompletedOrders()
{
    global $config;
    $str = "";
    $args = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $config['time'] . "&lkid=" . $config['lkid'] . "&currency=" . $config['currency'] . "&page=" . $config['page'] . "&sign=" . $sign;
    return curlRequest("list-promotion-products", $args);
}

function listPromotionProduct()
{
    global $config;
    $str = "";
    $args = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $config['time'] . "&lkid=" . $config['lkid'] . "&currency=" . $config['currency'] . "&page=" . $config['page'] . "&sign=" . $sign;
    return curlRequest("products/list-promotion-products", $args);
}


function listEventCreative($type, $category, $size)
{
    global $config;
    $str = "";
    $args = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $config['time'] . "&lkid=" . "&type=" . $type . "&category=" . $category . "&language=" . $config['language'] . "&size=" . $size . "&page=" . $config['page'] . "&sign=" . $sign . "&lkid=" . $config['lkid'];
    return curlRequest("banner/list-event-creative", $args);
}


function listProductCreative($type, $category)
{
    global $config;
    $str = "";
    $args = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $config['time'] . "&type=" . $type . "&category=" . $category . "&page=" . $config['page'] . "&sign=" . $sign . "&lkid=" . $config['lkid'];
    return curlRequest("promotions/list-product-creative", $args);
}


function listCoupons($type, $category)
{
    global $config;
    $str = "";
    $args = "";
    ksort($config);
    foreach ($config as $key => $val) {
        $str = $str . $key . $val;
    }
    $sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));
    $args = "api_key=" . $config['api_key'] . "&time=" . $config['time'] . "&language=" . $config['language'] . "&category=" . $category . "&page=" . $config['page'] . "&sign=" . $sign . "&lkid=" . $config['lkid'];
    return curlRequest("coupon/list-coupon", $args);
}
