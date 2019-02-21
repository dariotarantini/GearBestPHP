<?php

include "../src/GearBestPHP.php";

$cli = new GearBest("API_KEY", "API_SECRET");
var_dump($cli->listPromotionProduct());
