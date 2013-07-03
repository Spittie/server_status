#server_status
============

ServerStatus is based off [BlueVM's](http://uptime.bluevm.com/) Uptime Checker script, [original download and information](http://www.lowendtalk.com/discussion/comment/169690#Comment_169690).
Modified version, based of [BananaFish's ServerStatus](https://github.com/thebananafish/server_status).

It uses Bootstrap for theming and progress bars.

You can currently see Load, RAM (free), HDD (free) statistics, and if it is online or not.

# Screenshot
============
![Screenshot](http://img.installgentoo.com/di/3LFL/ss.png)

# Installation
============

1. Create a database with a user.
2. Configure /includes/config.php with the database and user information.
3. Run install.php, delete install.php
4. Copy uptime.php to any server you want to monitor. This needs to be publicly accessible.
5. Insert an entry into the database. You can use the WebUI under /add
  * name - The name of your server.
  * url - The URL path to the uptime.php file (minus uptime.php and http://) e.g. dns.domain.tld/path/
  * location - Where is your server physically located?
  * type - What type of server is this? DNS, SQL, Apache/nginx, etc.
6. Delete the WebUI folder (/add) or protect it with HTTP Auth (For Nginx see [here](http://www.howtoforge.com/basic-http-authentication-with-nginx) , for other server use Google)

# Requirements
============

**Remote Servers**:
* PHP5, currently php_exec needs to be enabled in order to get the uptime.
* Web Server (lighttpd, apache2, nginx, etc.)
* You do **NOT** need a database running on the remote servers.

**Master Server**:
* PHP5 + PHP5_CURL
* Web Server (lighttpd, apache2, nginx, etc.)
* and SQL server. There's support for MySQL, PostgreSQL > 9.1 and SQLite

# Difference from the original server_status
* Ported from MySQL_* to PDO
* Added support for SQLite
* PostgreSQL 9.1 and newer supported
* Basic WebUI

# Note
======
This does not properly report status of BSD based hosts.
