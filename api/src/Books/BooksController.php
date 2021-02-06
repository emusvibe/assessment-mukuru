<?php

namespace Api\Books;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class BooksController
{
    public function index(Request $request, Response $response)
    {
        $db = new \PDO('mysql:host=database;dbname=assess_db', 'root', 'secret');
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        $books = $db->query('SELECT * FROM books')
            ->fetchAll();

        return $response->getBody()->write(json_encode($books));
    }

    public function create(Request $request, Response $response)
    {
        $db = new \PDO('mysql:host=database;dbname=assess_db', 'root', 'secret');
        $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

        $params = $request->getQueryParams();

        // Create the new book
        $db->exec('INSERT INTO books (title, author_id) VALUES ("'.$params['title'].'", "'.$params['author_id'].'")');
        $book_id = $db->lastInsertId();

        // Create the ZAR price for the book
        $zar = $db->query('SELECT * FROM currencies WHERE iso = "ZAR"')->fetch();
        $db->exec('INSERT INTO book_pricing (book_id, currency_id, price) VALUES ('.$book_id.', '.$zar['id'].', '.$params['price']['ZAR'].')');

        // Create the USD price for the book
        $usd = $db->query('SELECT * FROM currencies WHERE iso = "USD"')->fetch();
        $db->exec('INSERT INTO book_pricing (book_id, currency_id, price) VALUES ('.$book_id.', '.$usd['id'].', '.$params['price']['USD'].')');
        
        // Create the GBP price for the book
        $gbp = $db->query('SELECT * FROM currencies WHERE iso = "GBP"')->fetch();
        $db->exec('INSERT INTO book_pricing (book_id, currency_id, price) VALUES ('.$book_id.', '.$gbp['id'].', '.$params['price']['GBP'].')');
        
        // Fetch the book we just created so we can return it in the response
        $return = $db->query('SELECT * FROM books WHERE id = '.$book_id)
            ->fetchAll();

        return $response->getBody()->write(json_encode($return));
    }
}
