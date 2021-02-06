<?php

namespace App\Books;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\Views\PhpRenderer;

class BooksController
{
    public function index(Request $request, Response $response)
    {
        // Get all the books to show
        $ch = curl_init('http://api.localtest.me/books');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $books = json_decode(curl_exec($ch));
        curl_close($ch);


        // Get all the authors
        $ch = curl_init('http://api.localtest.me/authors');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $authors = json_decode(curl_exec($ch));
        curl_close($ch);

        // Loop through all books and add the author to each one for use in the listing template
        foreach ($books as $key => $book) {
            foreach ($authors as $author) {
                if ($book->author_id == $author->id) {
                    $books[$key]->author = $author;
                }
            }
        }

        $renderer = new PhpRenderer('../src/Books/templates/');
        return $renderer->render($response, 'list.php', [
            'books' => $books,
        ]);
    }

    public function create(Request $request, Response $response)
    {
        // Check if form data has been sent
        if ($params = $request->getQueryParams()) {
            // Make the api call to create the book
            $ch = curl_init('http://api.localtest.me/books/create?'.http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);

            // Redirect back to book listing
            return $response->withStatus(302)->withHeader('Location', '/books');
        }

        // Get all the authors
        $ch = curl_init('http://api.localtest.me/authors');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $authors = json_decode(curl_exec($ch));
        curl_close($ch);

        $renderer = new PhpRenderer('../src/Books/templates/');

        return $renderer->render($response, 'create.php', [
            'authors' => $authors,
        ]);
    }
}
