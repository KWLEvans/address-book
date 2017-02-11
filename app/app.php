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
    $contacts = Contact::getAll();
    return $app["twig"]->render("home.html.twig", ["contacts" => $contacts]);
});

$app->post("/create_contact", function() use ($app) {
    $new_contact = new Contact($_POST["name"], $_POST["street"], $_POST["city"], $_POST["state"], $_POST["zip"], $_POST["email"], $_POST["phone"]);
    $new_contact->save();
    return $app["twig"]->render("create_contact.html.twig", ["contact" => $new_contact]);
});

$app->get("/delete_contacts", function() use ($app) {
    Contact::deleteAll();
    return $app["twig"]->render("delete_contacts.html.twig");
});

$app->get("/delete_one", function() use ($app) {
    $data = $_GET["userToDelete"];
    $target = Contact::getByName($data);
    Contact::delete($target);
    return true;
});

$app->get("/edit_one", function() use ($app) {
    $contact_name = $_GET["contactToEdit"];
    $contact = Contact::getByName($contact_name);
    return $app["twig"]->render("edit.html.twig", ["contact" => $contact]);
});

$app->post("/edit_submit", function() use ($app) {
    $contact = Contact::getByName($_POST["name"]);
    foreach ($_POST as $key => $value) {
      if ($key != "name") {
        $contact->set($key, $value);
      }
    }
    $contact->buildAddress();
    return $app["twig"]->render("home.html.twig", ["contacts" => Contact::getAll()]);
});

return $app;
?>
