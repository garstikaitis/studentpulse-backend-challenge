## Studentpulse backend challenge

Welcome to studentpulse backend challenge.
In this challenge you will need to finish building an API that does simple calculator functions:

-   Adds two numbers
-   Subtracts two numbers
-   Divides two numbers
-   Multiplies two numbers

The API is using [JSON web token](https://jwt.io) for authenticating. [Laravel JWT auth wrapper](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/) is used to handle JWT requests.

### Note

You don't need to work on authentication implementation, since it's basically copy/paste code from [Laravel JWT auth wrapper](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/) documentation. However your code needs to validate current authenticated user

## Challenge goal

Simply, you need to make tests pass. To run tests run `php artisan test` or `vendor/bin/phpunit`
Through out the codebase you will find comments `@TODO`. You need to fill in this code block with the actual code so tests would pass.

# Note

You can't modify/create tests assertions. However, if you feel like it, you can refactor existing tests, as long as test assertions are the same as it was before refactor.

## Getting started

1.  Clone the repo
2.  Create a new branch from `main`

3.  Change .env file with

```
DB_CONNECTION=sqlite
DB_DATABASE=./database/db.sqlite
```

4.  Create db.sqlite file in `${ROOT}/database` folder
5.  Run `php artisan migrate`
6.  Run `php artisan jwt:secret`

## Submitting solution

Once finished the challenge submit a PR. After that I will invite you for another talk where we will talk about your solution.

### Good luck 🤟
