### Installation

1- Go to project root path.
2- Run `php artisan migrate` command.
3- Run `php artisan db:seed` command.
- Note: In this command i create user with `admin@test.com` email and `admin` password and this user is admin.
 
### Authentication

* To call API routes you can run `php artisan auth:api_token {email}` command to get user token.

* Token usages:
    - Header: `Authorization: Bearer {token}`
    - params: `api_token={token}`

### Tests

Run `./vendor/bin/phpunit` to run tests.


### Routes
You should set `Accept: application/json` in header.

* Call `POST /api/admin/coupon` api: 
    - `name`(required and unique) 
    - `brand_id` (required)
    - `amount` (required)
    - `type` (required and one of: `unique | normal | offer` 
    - `status`(required and one of `active | expired | inactive`
    - `link` (optional)
    - `published_at` (optional , exp: `2020-03-13 19:26:00`)


* Call `GET /api/coupon` or `GET /api/admin/coupon` to get coupons list
    - filters[{key}]={value} (optional and key is one of `create_time | publish_time | brand_id`)
    
    Examples: 
        - month condition: filters[create_time]=2020-02
        - day condition: filters[create_time]=2020-02-01
        - hour condition: filters[create_time]=2020-02-01 4
    ***Note***: You can set multiple filters key.
      


* Call `GET /api/coupon-code` or `GET /api/admin/coupon-code` to get codes list
    - filters[{key}]={value} (optional and key is one of `coupon_id | assigned_by | assigned_to`)
    - limit=10 (optional)
    - page=1 (optional)
    ***Note***: You can see only code that is assigned to self user if user is not admin.
    

* Call `POST /api/admin/coupon-code` api: 
    - `coupon_id` 
    - `code` (file or string)
    
    ***Note***: This route is transactional. 

* Call `POST /api/admin/coupon-code/assign` api :

    - `coupon_id` required
    - `code` (optional) You assign special code to user
    - `user_id` (optional) You can set assignee user id . Assignee user id is assigner id if you don't set this param.
     

