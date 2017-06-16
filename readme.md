# Job Ads Checkout System

This application is a RESTful API implementation of a checkout system. It allows the calculation of the total price based on pricing rules on customer-ad relationships.

Some of its components are:
* RESTful endpoints
* Database migrations
* Test Cases

### Requirements

* PHP >= 5.6.4
* MySQL Database
* MySQL PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

Note: This application must be deployed on document root or virtual host

### Installation

1. Create a database in MySQL
2. Clone repository
3. Copy the file **.env.example** to **.env** and edit the URL and database settings
4. Go the main directory (where composer.json is located), e.g. `cd job-ads-checkout-system`
5. Run `composer install`. More details [here](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
6. Run `php artisan migrate:refresh --seed` to migrate and seed database tables

### Testing

This system has test cases to ensure components are working correctly. To run the test cases, simply run `./vendor/bin/phpunit` from the command line on the main directory.

Alternatively, you could also use a HTTP Client such as [Postman](https://www.getpostman.com/) to test the endpoints, as follows:
* **Ads**
    * `GET` **api/ads** - Show all ads
    * `GET` **api/ads/{id}** - Show a specific ad
* **Ad Orders**
    * `GET` **api/ad-orders** - Show all ad orders
    * `GET` **api/ad-orders/{id}** - Show a specific ad order
* **Customers** 
    * `GET` **api/customers** - Show all customers
    * `GET` **api/customers/{id}** - Show a specific customer
    * `POST` **api/customers** - Create a customer record. Body should contain the format: `{name: <string>}`
    * `PUT/PATCH` **api/customers/{id}** - Update a customer record. Body should contain: `{name: <string>}`
    * `DELETE` **api/customers/{id}** - Delete a customer record.
* **Pricing Rules** 
    * `GET` **api/pricing-rules** - Show all pricing rules
    * `GET` **api/pricing-rules/{id}** - Show a specific pricing rule
    * `POST` **api/pricing-rules** - Create a pricing rule record. Body should contain the format: `{customer_id: <integer>, ad_id: <integer>, price: <decimal>, min_qty: <integer>, continuous: <boolean>}`. The `continuous` field is used to determine whether a pricing rule is in **x for y** format, e.g. 5 for 4 or a **price drops to x when y or more are purchased** format
    * `PUT/PATCH` **api/pricing-rules/{id}** - Update a specific pricing rule. Body format should be similar above.
    * `DELETE` **api/pricing-rules/{id}** - Delete a pricing rule record.
* **Checkout** 
    * `POST` **api/checkout** - Initiates checkout. Body format should be: `{customer_id <integer>, items: <array of ad ids>}`. A successful response will contain the total price as well as the link to the newly-created **Ad Order** resource

### Contributing

If you want you contibute, please create an issue or submit a pull request.