### Installation

1- Go to project root path.
2- Run `php artisan migrate` command.
3- Run `php artisan db:seed` command.
- Note: In this command i create user with `admin@test.com` email and `admin` password.
 
### Authentication

* To call API routes you can run `php artisan auth:api_token {email}` command to get user token.

* Token usages:
    - Header: `Authentication: Bearer {token}`
    - params: `api_token={token}`


