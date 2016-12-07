rm -rf database/database.sqlite
touch database/database.sqlite
composer install
php artisan migrate
npm install --global gulp-cli
npm install
gulp
php artisan serve