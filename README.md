## About Project

This a solution of the challenge proposed by AlpesOne

- I'm use Laravel on last version
- Choose Laravel because is accessible, powerful, and provides tools required for large, robust applications.

## Installation

- composer install
- copy .env.example to .env
- run php artisan key:generate
- configuration database access
- run php artisan:migration
- run php artisan:serve
- open new terminal tab and run php artisan queue:work
- To fill database call uri /api/seed and waiting finish jobs

## Endpoint

##### /api/cars/search

This endpoint provider a search car based on filter, next filter enables:

- year
- doors
- gas 
- price 
- template_id 
- license_plate
- year_bigger_then
- year_less_then
- model_bigger_then
- model_less_then
- by_brand
- price_bigger_then
- price_less_then

#### How use filters ?

You can combine filter to get a result wish

/api/cars/search?filter[doors]=4&filter[model_bigger_then]=2017


if you choose a wrong value the endpoint response 422 with message.


##### api/cars/{car} 

this uri show a detail of car. Replace {car} for a valid id of Car.
If that id is not valid you receive 404


## License

The project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
