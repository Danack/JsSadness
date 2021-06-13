#!/usr/bin/env bash


docker-compose up --build installer

docker-compose up --build varnish nginx php_fpm php_fpm_debug js_dev_builder sass_dev_builder
