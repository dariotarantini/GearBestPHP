<?php

include "../src/GearBestPHP.php";

$cli = new GearBestPHP("API_KEY", "API_SECRET");
var_dump($cli->listPromotionProduct());
