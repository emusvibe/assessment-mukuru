<?php


use Phinx\Seed\AbstractSeed;

class AuthorSeeder extends AbstractSeed
{
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
        if (!$this->fetchAll('SELECT id FROM authors')) { //Only seed if no data
            $this->table('authors')
                ->insert([
                    [
                        'first_name' => 'Ernest',
                        'last_name' => 'Hemingway',
                    ],
                    [
                        'first_name' => 'Jane',
                        'last_name' => 'Austen',
                    ],
                    [
                        'first_name' => 'Mark',
                        'last_name' => 'Twain',
                    ],
                    [
                        'first_name' => 'Roald',
                        'last_name' => 'Dahl',
                    ],
                ])
                ->save();
        }
    }
}
