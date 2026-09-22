# DevForge Binary Directory Structure

This directory houses the service runtimes and development tools used by DevForge.

### Folder Layout
- `bin/apache/`: Apache HTTP Server binaries (`bin/httpd.exe`, `conf/`, `modules/`)
- `bin/php/<version>/`: PHP binaries (`php.exe`, `php-cgi.exe`, `ext/`, `php.ini`)
- `bin/mysql/`: MySQL Database Server (`bin/mysqld.exe`, `bin/mysql.exe`)
- `bin/node/<version>/`: Node.js runtime (`node.exe`, `npm.cmd`, `npx.cmd`)
- `bin/composer/`: Composer package manager (`composer.phar`, `composer.bat`)
- `bin/mailpit/`: Mailpit local email testing binary (`mailpit.exe`)
- `bin/phpmyadmin/`: phpMyAdmin web interface

> **Note:** If using the standalone installer from **Releases / Packages**, all binaries and prerequisites are pre-bundled and pre-configured out-of-the-box.
