From within this directory:

- Run composer install \
`docker run --rm --interactive --tty --volume ${PWD}:/app composer install`

- Run database migrations \
`docker-compose exec api php vendor/bin/phinx migrate`

- Insert seed data \
`docker-compose exec api php vendor/bin/phinx seed:run`
