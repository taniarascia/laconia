CONTAINER_NAME ?= my_app


start:
	docker-compose up -d 

stop:
	docker-compose stop

install:
	docker-compose up --build 
	docker-compose exec $(CONTAINER_NAME) /bin/bash php bin/install.php