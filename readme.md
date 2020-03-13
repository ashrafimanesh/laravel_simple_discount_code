### Installation

1- Go to project root path.
2- Run `php artisan migrate` command.
3- Run `php artisan db:seed` command.
- Note: In this command i create user with `admin@test.com` email and `admin` password.
 
### Authentication

* To call API routes you can run `php artisan auth:api_token {email}` command to get user token.

* Token usages:
    - Header: `Authorization: Bearer {token}`
    - params: `api_token={token}`

### Tests

Run `./vendor/bin/phpunit` to run tests.


### Assign code

* Call `/api/admin/coupon-code/assign` api :

    - `coupon_id` required
    - `code` (optional) You assign special code to user
    - `user_id` (optional) You can set assignee user id . Assignee user id is assigner id if you don't set this param.
     

