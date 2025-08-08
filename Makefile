build:
	docker-compose build

up:
	docker-compose up

up-d:
	docker-compose up -d

logs:
	docker-compose logs -f

down:
	docker-compose down

restart:
	docker-compose restart

php:
	docker-compose exec app /bin/bash

db:
	docker-compose exec db /bin/bash

nginx:
	docker-compose exec nginx /bin/bash

help:
	@echo "make build     # Build the Docker containers"
	@echo "make up-d      # Start the containers in detached mode"
	@echo "make up        # Start the containers"
	@echo "make logs      # Show container logs"
	@echo "make down      # Stop and remove containers"
	@echo "make restart   # Restart the containers"
	@echo "make php       # Open a shell in the app container"
	@echo "make db        # Open a shell in the db container"
	@echo "make nginx     # Open a shell in the nginx container"
