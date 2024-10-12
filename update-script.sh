#!/bin/bash

# Check if script is run with sudo
if [ "$EUID" -ne 0 ]; then
    echo "Please run as root (use sudo)."
    exit 1
fi

# Prompt for database migration
read -p "Migrate db? (y/n): " migrate_db

echo "Updating jexactyl-fork"

# Navigate to jexactyl directory
cd /var/www/jexactyl || {
    echo "Failed to navigate to /var/www/jexactyl. Trying /var/www/pterodactyl..."
    cd /var/www/pterodactyl || {
        echo "Failed to navigate to /var/www/pterodactyl."
        echo "Script failed."
        exit 1
    }
}

# Notify user about the next steps
echo "Running maintenance tasks..."

# Run the following commands
cd /var/www/jexactyl || cd /var/www/pterodactyl

echo "Putting application in maintenance mode..."
php artisan down || {
    echo "Failed to put application in maintenance mode. Trying with sudo..."
    sudo php artisan down
}

echo "Downloading the latest panel release..."
sudo curl -L https://github.com/kokofixcomputers/jexactyl/releases/latest/download/panel.tar.gz | sudo tar -xzv

echo "Setting permissions..."
sudo chown -R www-data:www-data *
sudo chmod -R 755 storage/* bootstrap/cache

echo "Installing dependencies..."
sudo composer install --no-dev --optimize-autoloader

# Only run database migrations if user chose to migrate
if [[ "$migrate_db" == "y" ]]; then
    echo "Running database migrations..."
    sudo php artisan migrate --seed --force
else
    echo "Database migration skipped."
fi

echo "Finishing up..."
sudo php artisan up
sudo chmod +x update-script.sh

echo "Update completed successfully."
