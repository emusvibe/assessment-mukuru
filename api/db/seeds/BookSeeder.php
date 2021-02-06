<?php


use Phinx\Seed\AbstractSeed;

class BookSeeder extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'AuthorSeeder',
        ];
    }

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

        if (!$this->fetchAll('SELECT id FROM books')) { //Only seed if no data
            $ernest = $this->fetchRow('SELECT id FROM authors WHERE first_name = "Ernest" AND last_name = "Hemingway"');
            $jane = $this->fetchRow('SELECT id FROM authors WHERE first_name = "Jane" AND last_name = "Austen"');
            $mark = $this->fetchRow('SELECT id FROM authors WHERE first_name = "Mark" AND last_name = "Twain"');

            $this->table('books')
                ->insert([
                    [
                        'author_id' => $ernest['id'],
                        'title' => 'The old man and the sea',
                    ],
                    [
                        'author_id' => $ernest['id'],
                        'title' => 'A Farewell to Arms',
                    ],
                    [
                        'author_id' => $jane['id'],
                        'title' => 'Pride and Prejudice',
                    ],
                    [
                        'author_id' => $jane['id'],
                        'title' => 'Sense and Sensibility',
                    ],
                    [
                        'author_id' => $mark['id'],
                        'title' => 'Roughing It',
                    ],
                    [
                        'author_id' => $mark['id'],
                        'title' => 'The Adventures of Tom Sawyer',
                    ],
                ])
                ->save();
        }
    }
}
