# Origin-Data-PHP-Interview

### Mid PHP Developer Origin-Data Project Requirements:

-Design a company module where you have companies data with their employees data and projects;

-Create a RESTful API  which you can apply CRUD on each module;

-The API should be allow only authenticated users to apply Create, Update, Delete;

-Don't forget about relationships, migrations and seeders;

-Dockerize the app to run at port 8080;

### To run:

`composer require laravel/passport`
`php artisan migrate`
`php artisan passport:install`

##

Don't forget, after migration / seeding to install artisan passport.
Login a new user with name, email and pass to `/api/login`:
    - header: Accept application/json REQUIRED ON EVERY CALL (LOGIN, REGISTER, POST, ...)

To login: `./api/login`
To register: `./api/register`

##

Authorization: Bearer Token. Register new user. Loggin, copy accessToken and paste to authorization (Bearer Token) while keeping the Accept header as application/json.

##

all routes available via:

`php artisan route:list`

## On every DB migration:
`php artisan passport:install --force`