current-dir := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
SHELL = /bin/sh

# Variables
COMPOSE := docker compose
USER_CONTAINER := microservice_user_php
DATABASE_USER_CONTAINER := microservice_user_database
EMAIL_CONTAINER := microservice_email_php
AMBASSADOR_CONTAINER := microservice_ambassador_php
DATABASE_CONTAINER := microservice_ambassador_database
SHARED_RABBITMQ := shared_rabbitmq

# 🐳 Docker Compose

.PHONY: build
build: start

.PHONY: start
start: COMPOSE_COMMAND=up -d --build
start: docker-compose-all

.PHONY: stop
stop:
	docker stop $(EMAIL_CONTAINER) $(AMBASSADOR_CONTAINER) $(DATABASE_CONTAINER) $(SHARED_RABBITMQ) $(USER_CONTAINER) $(DATABASE_USER_CONTAINER)

.PHONY: destroy
destroy:
	docker rm $(EMAIL_CONTAINER) $(AMBASSADOR_CONTAINER) $(DATABASE_CONTAINER) $(SHARED_RABBITMQ) $(USER_CONTAINER) $(DATABASE_USER_CONTAINER)

# Objetivo genérico para docker-compose en subdirectorios
define docker-compose-command
	UID=$$(id -u) GID=$$(id -g) cd $(1) && $(COMPOSE) $(2)
endef

.PHONY: doco-email
doco-email:
	$(call docker-compose-command,microservices/email,$(COMPOSE_COMMAND))

.PHONY: doco-ambassador
doco-ambassador:
	$(call docker-compose-command,microservices/ambassador,$(COMPOSE_COMMAND))

.PHONY: doco-shared_rabbitmq
doco-shared_rabbitmq:
	$(call docker-compose-command,microservices/rabbitmq,$(COMPOSE_COMMAND))

.PHONY: doco-user
doco-user:
	$(call docker-compose-command,microservices/user,$(COMPOSE_COMMAND))

.PHONY: start-email
start-email: COMPOSE_COMMAND=up -d
start-email: doco-email

.PHONY: start-ambassador
start-ambassador: COMPOSE_COMMAND=up -d
start-ambassador: doco-ambassador

.PHONY: docker-compose-all
docker-compose-all: doco-email doco-ambassador doco-shared_rabbitmq doco-user

.PHONY: deps
deps: deps-email deps-ambassador

.PHONY: deps-email
deps-email:
	docker exec $(EMAIL_CONTAINER) composer install
	docker exec $(EMAIL_CONTAINER) bash -c "if [ ! -f .env ]; then cp .env.example .env; fi"

.PHONY: deps-ambassador
deps-ambassador:
	docker exec $(AMBASSADOR_CONTAINER) composer install
	docker exec $(AMBASSADOR_CONTAINER) bash -c "if [ ! -f .env ]; then cp .env.example .env; fi"