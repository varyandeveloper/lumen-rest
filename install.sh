#!/usr/bin/env bash

env_file="./.env"

copy_env_exit () {
    cp ./.env.example "$env_file"
    echo '
Done! please set configurations inside .env file and rerun installation.'
}

install_app () {
    # install all dependencies
    composer install

    # Create new tables for Passport
    php artisan migrate

    # Install encryption keys and other necessary stuff for Passport
    php artisan passport:install

    # show app tests before running
    ./vendor/bin/phpunit

    # set app key
    php install.php

    # up docker container
    # docker-compose up -d
}

if [ -f "$env_file" ]
then
    install_app
else
    echo "$env_file not found."

    read -n 1 -p "Do you want to create copy of environment file? y\N :" answer

    if [ "$answer" = "y" ]; then
        copy_env_exit
    elif [ "$answer" == "Y" ]; then
        copy_env_exit
    fi
fi
