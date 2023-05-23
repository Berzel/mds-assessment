## MDS Assessment

# How to run
- Make sure you've docker installed
- git clone this repo to your local machine
- cd to the project directory
- cp .env.example .env
- run composer install
- run npm install
- run npm run build
- run ./vendor/bin/sail up -d
- run ./vendor/bin/sail artisan:migrate --seed
- visit http://localhost and log in with username:test@example.com, password:password
