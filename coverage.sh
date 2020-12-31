#!/bin/bash

mkdir ../shop-graphql
cd ../shop-graphql
cp -r $TRAVIS_BUILD_DIR/vendor/oxid-esales/oxideshop-ce/* ./
composer update $DEFAULT_COMPOSER_FLAGS

#composer require oxid-esales/graphql-base:dev-coverage # TODO: Use `composer require oxid-esales/graphql-base:dev-$TRAVIS_BRANCH` on Travis
composer require oxid-esales/graphql-base:dev-$TRAVIS_BRANCH

# For remote code coverage report to work we need to install `c3.php` and require it in the eShops `bootstrap.php` file
composer require codeception/module-phpbrowser codeception/c3 --dev

sed -i 's/<?php/<?php\n\nrequire(__DIR__ . "\/..\/c3.php");/' source/bootstrap.php

cp ./source/config.inc.php.dist ./source/config.inc.php
chmod 0777 ./source/log

composer require codeception/module-rest --dev
composer require codeception/module-phpbrowser --dev

# prepare configuration

sed -i 's|<dbHost>|127.0.0.1|' source/config.inc.php
sed -i 's|<dbName>|oxideshop|' source/config.inc.php
sed -i 's|<dbUser>|root|' source/config.inc.php
sed -i 's|<dbPwd>||' source/config.inc.php
sed -i 's|<sShopURL>|http://127.0.0.1:8080|' source/config.inc.php
sed -i "s|'<sShopDir>'|__DIR__|" source/config.inc.php
sed -i "s|'<sCompileDir>'|__DIR__ . '/tmp'|" source/config.inc.php
sed -i "s|blSkipViewUsage = false|blSkipViewUsage = true|" source/config.inc.php

sed -i "s|source/modules/oe/graphql-base/tests/codeception.yml|$TRAVIS_BUILD_DIR/source/modules/oe/graphql-base/tests/codeception.yml|" source/modules/oe/graphql-base/tests/codeception.yml

# start mysql and import
sudo sed -e 's|utf8_unicode_ci|latin1_general_ci|g; s|utf8|latin1|g' --in-place /etc/mysql/my.cnf
sudo service mysql restart

# start php built-in webserver
php -S 127.0.0.1:8080 -t ./source &

# wait for it ;-)
sleep 2;

vendor/bin/reset-shop
composer clearcache
composer update

sudo service mysql restart

sudo chmod +775 c3.php

# Try to run tests and then coverage
# vendor/bin/codecept -c vendor/oxid-esales/graphql-base/tests/ run

ls source/modules/oe/graphql-base/


vendor/bin/codecept -c source/modules/oe/graphql-base/tests/ run --coverage --coverage-html
