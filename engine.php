<?php
$file = file_get_contents('./config.json');
$config = json_decode($file, true);
$time = time();

function curlRequest($method, $args)
{
	$c = curl_init();
	curl_setopt($c, CURLOPT_HEADER, 0);
	curl_setopt($c, CURLOPT_URL, 'https://affiliate.gearbest.com/api/' . $method . '?' . http_build_query($args));
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$r = curl_exec($c);
	curl_close($c);
	return json_decode($r, true);
}




function getCompletedOrders($start_date, $end_date, $status = NULL, $page = NULL)
{
	global $config;
	global $time;

	$str = '';

	$args = [
		'api_key' => $config['api_key'],
		'time' => $time,
		'start_date' => $start_date,
		'end_date' => $end_date
	];
	if(isset($status))
	{
		$args['status'] = $status;
	}
	if(isset($page))
	{
		$args['page'] = $page;
	}

	ksort($args);
	foreach ($args as $key => $val) {
		$str = $str . $key . $val;
	}
	$sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));

	$args['sign'] = $sign;

	return curlRequest('orders/completed-orders/', $args);
}


function listPromotionProduct($lkid = NULL, $page = NULL, $keywords = NULL, $category	 = NULL)
{
	global $config;
	global $time;

	$str = '';

	$args = [
		'api_key' => $config['api_key'],
		'time' => $time,
		'currency' => $config['currency']
	];
	if(isset($lkid))
	{
		$args['lkid'] = $lkid;
	}
	if(isset($page))
	{
		$args['page'] = $page;
	}
	if(isset($keywords))
	{
		$args['keywords'] = $keywords;
	}
	if(isset($category))
	{
		$args['category'] = $category;
	}

	ksort($args);
	foreach ($args as $key => $val) {
		$str = $str . $key . $val;
	}
	$sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));

	$args['sign'] = $sign;

	return curlRequest('products/list-promotion-products/', $args);
}


function listEventCreative($type, $lkid = NULL, $page = NULL, $language = NULL, $size = NULL, $category = NULL)
{
	global $config;
	global $time;

	$str = '';

	$args = [
		'api_key' => $config['api_key'],
		'time' => $time,
		'type' => $type
	];
	if(isset($lkid))
	{
		$args['lkid'] = $lkid;
	}
	if(isset($page))
	{
		$args['page'] = $page;
	}
	if(isset($language))
	{
		$args['language'] = $language;
	}
	if(isset($size))
	{
		$args['size'] = $size;
	}
	if(isset($category))
	{
		$args['category'] = $category;
	}

	ksort($args);
	foreach ($args as $key => $val) {
		$str = $str . $key . $val;
	}
	$sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));

	$args['sign'] = $sign;

	return curlRequest('banner/list-event-creative/', $args);
}


function listProductCreative($type, $lkid = NULL, $category = NULL, $page = NULL)
{
	global $config;
	global $time;

	$str = '';

	$args = [
		'api_key' => $config['api_key'],
		'time' => $time,
		'type' => $type
	];
	if(isset($lkid))
	{
		$args['lkid'] = $lkid;
	}
	if(isset($category))
	{
		$args['category'] = $category;
	}
	if(isset($page))
	{
		$args['page'] = $page;
	}

	ksort($args);
	foreach ($args as $key => $val) {
		$str = $str . $key . $val;
	}
	$sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));

	$args['sign'] = $sign;

	return curlRequest('promotions/list-product-creative/', $args);
}


function listCoupons($lkid = NULL, $language = NULL, $category = NULL, $page = NULL)
{
	global $config;
	global $time;

	$str = '';

	$args = [
		'api_key' => $config['api_key'],
		'time' => $time
	];
	if(isset($lkid))
	{
		$args['lkid'] = $lkid;
	}
	if(isset($language))
	{
		$args['language'] = $language;
	}
	if(isset($category))
	{
		$args['category'] = $category;
	}
	if(isset($page))
	{
		$args['page'] = $page;
	}

	ksort($args);
	foreach ($args as $key => $val) {
		$str = $str . $key . $val;
	}
	$sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));

	$args['sign'] = $sign;

	return curlRequest('coupon/list-coupons/', $args);
}


//$urls and $link_names must be arrays
function getPromotionLinks($associate_id, $urls, $link_names = NULL)
{
	global $config;
	global $time;

	$str = '';
	$str_urls = '';

	foreach($urls as $val2) {
		if($str_urls == '')
		{
			$str_urls = $str_urls . $val2;
		}
		else
		{
			$str_urls = $str_urls . ',' . $val2;
		}
	}

	$args = [
		'api_key' => $config['api_key'],
		'time' => $time,
		'associate_id' => $associate_id,
		'urls' => $str_urls
	];
	if(isset($link_names))
	{
		$str_link_names = '';

		foreach($link_names as $val3)
		{
			if($str_link_names == '')
			{
				$str_link_names = $str_link_names . $val3;
			}
			else
			{
				$str_link_names = $str_link_names . ',' . $val3;
			}
		}

		$args['link_names'] = $str_link_names;
	}

	ksort($args);
	foreach ($args as $key => $val) {
		$str = $str . $key . $val;
	}
	$sign = strtoupper(md5($config['api_secret'] . $str . $config['api_secret']));

	$args['sign'] = $sign;

	return curlRequest('promotions/get-promotion-links/', $args);
}
