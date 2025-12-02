#!/bin/bash

# Usage: sudo ./setup.sh DB_USER DB_PASSWORD
DB_USER=$1
DB_PASSWORD=$2

if [ -z "$DB_USER" ] || [ -z "$DB_PASSWORD" ]; then
    echo "Usage: sudo ./setup.sh <db_user> <db_password>"
    exit 1
fi

# 1. Create database and user
echo "Creating MySQL database and user..."
mysql -u root -p <<MYSQL_SCRIPT
CREATE DATABASE IF NOT EXISTS support_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '$DB_USER'@'localhost' IDENTIFIED BY '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON support_system.* TO '$DB_USER'@'localhost';
FLUSH PRIVILEGES;
MYSQL_SCRIPT

echo "Database and user created."

# 2. Update .env file
echo "Updating Laravel .env..."
sed -i "s/DB_USERNAME=.*/DB_USERNAME=$DB_USER/" /var/www/support_system/.env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" /var/www/support_system/.env

# 3. Generate app key
cd /var/www/support_system
php artisan key:generate

# 4. Run migrations and seeders
echo "Running migrations and seeding users..."
php artisan migrate --seed

echo "Setup complete! Users and database ready."
