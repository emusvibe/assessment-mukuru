<?php

// Bootstrap Slim Framework
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true, // you would want this false in production
    ],
]);

$app->get('/authors', '\Api\Authors\AuthorsController:index');

$app->get('/books', '\Api\Books\BooksController:index');
$app->get('/books/create', '\Api\Books\BooksController:create');

$app->run();
