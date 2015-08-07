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

  $app->get("/", function() use ($app) {
    return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getAll()));
  });

  $app->post("/contacts", function() use ($app) {
    $contact = new Contact($_POST['name', 'phone_number', 'address']);
    $contact->save();
    return $app['twig']->render('create_contact.html.twig', array('new_contact' => $contact));
  });

  $app->post("/delete_contacts", function () use ($app) {
    Contact::deleteAll();
    return $app['twig']->render('delete_contacts.html.twig');
  });

  return $app;

?>
