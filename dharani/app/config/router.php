<?php

$router = $di->getRouter();

// Define your routes here
// $router->get(
//     '/index/userData/{name}/{id}',
//     array("controller" => "index",
//            "action" => "userData"));

//$router->add(
//    '/user/edit',
//    'User::edit'
//)->via(
//    [
//        'POST',
//        'PUT',
//    ]
//);
//$router->addPost(
//    '/user/edit/{id}',
//    'user::edit'
//);

//  use \Phalcon\Mvc\Micro\Collection as MicroCollection;
//  
//  $app = new \Phalcon\Mvc\Micro();
//
//$collection = new MicroCollection();
//$collection->setHandler("user" ,"UserController");
//  
//$collection->post("/user/edit", "edit");
//
//$app->mount($collection);

$router->handle();
