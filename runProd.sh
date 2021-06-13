#!/usr/bin/env bash

docker-compose -f docker-compose.yml -f docker-compose.prod.yml up  --build --force-recreate installer
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up  --build --force-recreate js_sass_prod_builder

docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build --force-recreate varnish nginx php_fpm
