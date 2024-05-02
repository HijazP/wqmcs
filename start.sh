#!/bin/sh
cp .env.example .env
sed -i -e 's/APP_ENV=local/APP_ENV=production/' .env
sed -i -e 's/APP_DEBUG=true/APP_ENV=false/' .env
sed -i -e 's,APP_URL=http://localhost,APP_URL=http://localhost:8000,' .env
sed -i -e 's/DB_HOST=127.0.0.1/DB_HOST=db/' .env
sed -i -e 's/DB_USERNAME=root/DB_USERNAME=user/' .env
sed -i -e 's/DB_PASSWORD=/DB_PASSWORD=password/' .env
