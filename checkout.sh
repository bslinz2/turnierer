# dependencies
composer install

# database
rm -rf database/database.sqlite
touch database/database.sqlite
php artisan migrate

# frontend
npm install --global gulp-cli
npm install
gulp

# make log files and database read and writeable
chmod -R 777 storage
chmod 777 database/database.sqlite

# local webserver
php artisan serve
