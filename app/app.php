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

$app->get("/", function() use ($app) {
    $contacts = "";
    return $app["twig"]->render("home.html.twig", ["contacts" => $contacts]);
});

$app->post("/create_contact", function() use ($app) {
    $new_contact = new Contact($_POST["name"], $_POST["email"], $_POST["phone"]);
    return $app["twig"]->render("create_contact.html.twig", ["contact" => $new_contact]);
});

return $app;
?>
