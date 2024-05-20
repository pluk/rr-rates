# RoadRunner Sandbox

- roadrunner as application server
- package by feature structure

### Start application
``
make init
``

### Fill with data
``
make import-rates
``


#### Get latest rate
`curl localhost:8080/rates`
#### Get rate by currency
`curl 'localhost:8080/rates?currency=EUR'`
#### Get rate by date
`curl 'localhost:8080/rates?date=2024-05-15'`
#### Get cross rate
`curl 'localhost:8080/rates?currency=EUR&base_currency=USD'`