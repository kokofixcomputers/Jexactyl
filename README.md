[![Logo Image](https://cdn.discordapp.com/attachments/1012411945141424218/1012430446556090468/JexactylBannerBasic.jpg)](https://jexactyl.com)

![Downloads - Total](https://img.shields.io/github/downloads/kokofixcomputers/jexactyl/total?style=for-the-badge)
![Downloads - Latest](https://img.shields.io/github/downloads/kokofixcomputers/jexactyl/latest/total?style=for-the-badge)
![Version](https://img.shields.io/github/v/release/kokofixcomputers/jexactyl?style=for-the-badge)
![Contributors](https://img.shields.io/github/contributors-anon/kokofixcomputers/jexactyl?style=for-the-badge)

<h1 align="center">Jexactyl</h1>
<h5 align="center">
    <strong>
        Jexactyl is a fast, advanced and customisable game management panel and billing system in one.
        Give your users the edge in terms of performance, reliability and pure functionality.
        NOTE: THIS IS A FORK OF JEXACTYL, IMPROVING JEXACTYL. THIS IS NOT PROJECT IS NOT AFFILIATED WITH THE ORIGINAL PROJECT.
    </strong>
</h5>

## Installation
### Method 1
Install the original jexactyl first, then run these commands:
```bash
cd /var/www/jexactyl # If you've migrated to jexactyl, run cd /var/www/pterodactyl
php artisan down # If it doesn't work, try running with sudo
sudo curl -L https://github.com/kokofixcomputers/jexactyl/releases/latest/download/panel.tar.gz | sudo tar -xzv # You may remove sudo from both ends of the command. But it might not work. for me, it didn't.
sudo chmod -R 755 storage/* bootstrap/cache # Set the permissions
composer install --no-dev --optimize-autoloader # if it doesn't work, run with sudo.
php artisan migrate --seed --force # if it doesn't work, run with sudo.
```
Then, Run **ONE** of these based on what your using:
```bash
# If using NGINX or Apache (not on CentOS):
chown -R www-data:www-data *

# If using NGINX on CentOS:
chown -R nginx:nginx *

# If using Apache on CentOS
chown -R apache:apache *
```

Finally, Run
```bash
php artisan up # if it doesn't work, run with sudo.
```
### Method 2
Install jexactyl as written in the docs:
```bash
apt -y install software-properties-common curl apt-transport-https ca-certificates gnupg

LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
add-apt-repository ppa:redislabs/redis -y

# The command below is not needed if you are using Ubuntu 22.04 or higher.
curl -sS https://downloads.mariadb.com/MariaDB/mariadb_repo_setup | sudo bash

apt update
apt -y install php8.1 php8.1-{cli,gd,mysql,pdo,mbstring,tokenizer,bcmath,xml,fpm,curl,zip} mariadb-server nginx tar unzip git redis-server
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```
The rest is continued in the official docs of jexactyl starting [here](https://docs.jexactyl.com/#/latest/panel/install/database)

Make the directory:
```bash
mkdir -p /var/www/jexactyl
cd /var/www/jexactyl
```

and here comes the diffrent part, downloading the files:
```bash
curl -Lo panel.tar.gz https://github.com/kokofixcomputers/jexactyl/releases/latest/download/panel.tar.gz
tar -xzvf panel.tar.gz
chmod -R 755 storage/* bootstrap/cache/
```

## Things i added/fixed
- Make descriptions for info and errors more clear
- Kill button
- Power Icons
- Added labels for required resources in server creation and resource shop
- Added coupon label in shop
- Added coupon button in resources shop
- Tell people to visit store front to create servers. (I was confused when i started using this. I didn't know to go to store front)
- MANY MORE!

## Why use Jexactyl?
* Billing system which supports [Stripe](https://stripe.com) and [PayPal](https://paypal.com) out of the box.
* Full customizability via a simple administrative dashboard.
* Ticket system in order to provide support to customers.
* Enhanced customisability and configurations.
* A fluent UI/UX with an easy-to-use API for both admins and clients.
* User approvals, server renewals, and much much more.

## Sponsors
*Want to sponsor Jexactyl? [Donate Here.](https://donate.stripe.com/6oE02Zftd9cC34IbIS)*

| Company | About | Link |
| ------- | ----- | ------- |
| [**HostEZ**](https://hostez.io) | Providing North America Valheim, Minecraft and other popular games with low latency, high uptime and maximum availability. EZ! | [Website](https://hostez.io) |
| [**Nero Nodes**](https://neronodes.net) | A Minecraft server provider that's completely free, 24/7. | [GitHub](https://github.com/nero-nodes) |
| [**Lightbulb Host**](https://lightbulb.host) | A Discord bot host that offers free hosting, 24/7. | [Discord](https://discord.wumpus.host) |
| [**ShadowHub Hosting**](https://shadowhub.tk) | Free discord bot & web server Hosting, with cheap VPS. | [Discord](https://discord.gg/sXxJ7PkhC3) |
| [**ZipCloud**](https://discord.gg/f4rbEmYAXb) | Game & VPS hosting with full DDoS protection and great uptime. | [Discord](https://discord.gg/f4rbEmYAXb) |

## Previews
![image](https://user-images.githubusercontent.com/72230943/201116518-af5e3291-74f7-433a-b035-6d80e8c7e8f8.png)
![image](https://user-images.githubusercontent.com/72230943/201116580-ae864e7c-aac7-4766-ab9c-c6cb97d0b015.png)
![image](https://user-images.githubusercontent.com/72230943/201116688-b53d721e-c30f-424e-8a53-025f313ec98f.png)
![image](https://user-images.githubusercontent.com/72230943/201116840-92c00c15-5717-4121-83cd-69397f9bacba.png)
![image](https://user-images.githubusercontent.com/72230943/201116914-8b1c8867-c462-4b25-ae47-803b2e4ea39c.png)
![image](https://user-images.githubusercontent.com/72230943/201116959-a626e6fc-18a9-4c06-869e-2f13b37b8457.png)
![image](https://user-images.githubusercontent.com/72230943/201117028-3db8aa2e-b14b-4679-9f2c-c5afb208767c.png)


## Licensing
Some Javascript and CSS used within the panel are licensed under a `MIT` or `Apache 2.0` license. Please check their
respective header files for more information.

Thanks to [https://github.com/Sigma-Production/PteroFreeStuffinstaller/tree/V1.10.1](https://github.com/Sigma-Production/PteroFreeStuffinstaller/tree/V1.10.1) for the kill button

*Jexactyl is not affiliated with [Pterodactyl Software](https://pterodactyl.io).*
