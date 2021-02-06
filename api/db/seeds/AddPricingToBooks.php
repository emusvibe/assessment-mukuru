<?php


use Phinx\Seed\AbstractSeed;

class AddPricingToBooks extends AbstractSeed
{
    public function getDependencies()
    {
        return [
            'BookSeeder',
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
        if (!$this->fetchAll('SELECT id FROM currencies')) { //Only seed if no data
            $this->table('currencies')
                ->insert([
                    [
                        'iso' => 'ZAR',
                        'name' => 'South African Rand',
                    ],
                    [
                        'iso' => 'USD',
                        'name' => 'United States Dollars',
                    ],
                    [
                        'iso' => 'GBP',
                        'name' => 'Great British Pounds',
                    ],
                ])
                ->save();

            $zar = $this->fetchRow('SELECT id FROM currencies WHERE iso = "ZAR"');
            $usd = $this->fetchRow('SELECT id FROM currencies WHERE iso = "USD"');
            $gbp = $this->fetchRow('SELECT id FROM currencies WHERE iso = "GBP"');

            $old_man = $this->fetchRow('SELECT id FROM books WHERE title = "The old man and the sea"');
            $farewell_arms = $this->fetchRow('SELECT id FROM books WHERE title = "A Farewell to Arms"');
            $pride = $this->fetchRow('SELECT id FROM books WHERE title = "Pride and Prejudice"');
            $sense = $this->fetchRow('SELECT id FROM books WHERE title = "Sense and Sensibility"');

            $this->table('book_pricing')
                ->insert([
                    [
                        'book_id' => $old_man['id'],
                        'currency_id' => $zar['id'],
                        'price' => 120.99,
                    ],
                    [
                        'book_id' => $old_man['id'],
                        'currency_id' => $usd['id'],
                        'price' => 10.99,
                    ],
                    [
                        'book_id' => $old_man['id'],
                        'currency_id' => $gbp['id'],
                        'price' => 150.99,
                    ],

                    [
                        'book_id' => $farewell_arms['id'],
                        'currency_id' => $zar['id'],
                        'price' => 145.49,
                    ],
                    [
                        'book_id' => $farewell_arms['id'],
                        'currency_id' => $usd['id'],
                        'price' => 12.00,
                    ],
                    [
                        'book_id' => $farewell_arms['id'],
                        'currency_id' => $gbp['id'],
                        'price' => 175.99,
                    ],

                    [
                        'book_id' => $pride['id'],
                        'currency_id' => $zar['id'],
                        'price' => 120.00,
                    ],
                    [
                        'book_id' => $pride['id'],
                        'currency_id' => $usd['id'],
                        'price' => 8.00,
                    ],
                    [
                        'book_id' => $sense['id'],
                        'currency_id' => $zar['id'],
                        'price' => 97.00,
                    ],
                ])
                ->save();
        }
    }
}
