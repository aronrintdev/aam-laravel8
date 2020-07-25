#!/bin/sh

php artisan l5-swagger:generate; cp app/Http/Swagger/jsonapi-schema.json ./storage/api-docs/
