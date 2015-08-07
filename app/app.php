<?php

  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Contact.php";

  session_start();

  if(empty($_SESSION['list_of_contacts']))
  {
    $_SESSION['list_of_contacts'] = array();
  }

  $app = new Silex\Application();

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

//renders the main page displaying all contacts
  $app->get("/", function() use ($app) {
    return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getAll()));
  });

//renders the create_contact page, which posts and displays the new contact info entered
  $app->post("/contacts", function() use ($app) {
    $contact = new Contact($_POST['name'], $_POST['phone_number'], $_POST['address']);
    $contact->save();
    return $app['twig']->render('create_contact.html.twig', array('new_contact' => $contact));
  });

//renders the delete_contacts page and deletes all current contacts
  $app->post("/delete_contacts", function () use ($app) {
    Contact::deleteAll();
    return $app['twig']->render('delete_contacts.html.twig');
  });

  return $app;

?>
