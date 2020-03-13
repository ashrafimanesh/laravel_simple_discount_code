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


### Routes

* Call `/api/admin/coupon` api: 
    - `name`(required and unique) 
    - `brand_id` (required)
    - `amount` (required)
    - `type` (required and one of: `unique | normal | offer` 
    - `status`(required and one of `active | expired | inactive`
    - `link` (optional)
    - `published_at` (optional , exp: `2020-03-13 19:26:00`)

* Call `/api/admin/coupon-code` api: 
    - `coupon_id` 
    - `code` (file or string)
Note: This route is transactional. 

* Call `/api/admin/coupon-code/assign` api :

    - `coupon_id` required
    - `code` (optional) You assign special code to user
    - `user_id` (optional) You can set assignee user id . Assignee user id is assigner id if you don't set this param.
     

