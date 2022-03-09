# どんなdockerイメージを利用して構築をするか
FROM php:7.4-apache

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
ADD docker/app/php.ini /usr/local/etc/php/
ADD docker/app/000-default.conf /etc/apache2/sites-enabled/

# Composerのインストール
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# ミドルウェアインストール
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
libpng-dev \
libpq-dev \
&& docker-php-ext-install pdo_mysql

# Laravelで必要になるmodRewriteを有効化する
RUN mv /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled
RUN /bin/sh -c a2enmod rewrite

#srcディレクトリをコピーする
COPY /src /var/www/html

#/vendorディレクトリの生成
RUN cd /var/www/html/laravelapp && composer install --optimize-autoloader --no-dev

#ストレージの権限を変更
#RUN chmod 777 /var/www/html/laravelapp/storage/logs/laravel.log
RUN chmod -R guo+w /var/www/html/laravelapp/storage

RUN cd /var/www/html/laravelapp && php artisan key:generate
RUN cd /var/www/html/laravelapp && php artisan config:clear
RUN cd /var/www/html/laravelapp && php artisan config:cache
RUN cd /var/www/html/laravelapp && php artisan optimize