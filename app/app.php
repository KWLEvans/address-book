<?php

date_default_timezone_set("America/Los_Angeles");
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/contact.php";

session_start();
if (empty($_SESSION["contact_list"])) {
  $_SESSION["contact_list"] = [];
}

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

?>
