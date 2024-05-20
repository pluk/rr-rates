
init: build run migration test

build:
	docker-compose down
	docker-compose build
	docker run --rm -v ./:/app -w /app rr-rates-rr composer install --prefer-dist --no-progress --no-interaction --quiet

run:
	docker-compose up -d

migration:
	docker-compose exec -it rr bin/console doctrine:migrations:migrate -n

test:
	curl localhost:8080/rates

import-rates:
	docker-compose exec -it rr bin/console rates:cbr_fetch 10