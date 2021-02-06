## Quickstart

- From within this directory, bring up the docker containers \
`docker-compose up --build`

- Follow the instructions in the `./api/readme.md` and `./app/readme.md` to run service specific setup like installing the dependencies and running the migrations 

- Browse to http://app.localtest.me:8080/

## Overview

This project is a very simple web app for managing a list of books. There are 2 pages

- http://app.localtest.me:8080/books \
Shows a list of all the books in the system

- http://app.localtest.me:8080/books/create \
Allows a user to create a new book

The books are retrieved and created via an API that at http://api.localtest.me:8080/. All the endpoints return a json
body:

- `GET` http://api.localtest.me:8080/authors \
Get a list of all the authors in the system

- `GET` http://api.localtest.me:8080/books \
Get a list of all books in the system

- `GET` http://api.localtest.me:8080/books/create \
Create a new book. The follow query parameters can be sent:
    - title  `string`
    - author_id `integer`
    - price[ZAR] `float`

## Basic Architecture

This app consists of 2 separate codebases contained in 1 repo. The `/app` codebase handles the web frontend and the
`/api` codebase handles for data retrieval and creation. Each codebase is entirely self contained and does not share
code with the other. They can only communicate over http.

The entry point into each app is `/[app|api]/public/index.php`. All this file does is require the composer autoloader
and a `/[app|api]/src/routes.php` file.

The `routes.php` file boots up Slim Framework v3 and defines the routes for each codebase.