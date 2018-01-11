#!/bin/bash
php artisan migrate
php artisan optimize
php artisan route:cache
php artisan config:cache
#