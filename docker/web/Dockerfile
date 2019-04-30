FROM centos:centos7.3.1611

# TimeZone設定
RUN echo 'ZONE"=Asia/Tokyo"' > /etc/sysconfig/clock

# yumアップデート, 各種インストール
RUN yum -y update
RUN yum -y install yum-plugin-priorities
RUN yum -y install wget
RUN yum -y install git
RUN yum -y install unzip
RUN yum -y install net-tools
RUN yum -y groupinstall "Base" "Development tools" "Japanese Support"

# httpdをインストール
RUN yum install -y httpd
RUN rm -rf /etc/httpd/conf.d/welcome.conf

# httpd.conf編集
RUN sed -i "s/#ServerName www\.example\.com:80/ServerName localhost:80/g" /etc/httpd/conf/httpd.conf
RUN sed -i -e '/<Directory "\/var\/www\/html">/,/<\/Directory>/s/    AllowOverride None/    AllowOverride All/' /etc/httpd/conf/httpd.conf
RUN sed -i -e 's/#EnableSendfile off/EnableSendfile off/' /etc/httpd/conf/httpd.conf
RUN sed -i -e 's/DocumentRoot "\/var\/www\/html"/DocumentRoot "\/var\/www\/html\/public"/' /etc/httpd/conf/httpd.conf

# リポジトリ追加
RUN yum -y install epel-release
RUN rpm -ivh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
# RUN yum -y install http://pkgs.repoforge.org/rpmforge-release/rpmforge-release-0.5.3-1.el7.rf.x86_64.rpm
RUN yum-config-manager --enable remi-php71

# PHP7, phpMyAdmin, 拡張パッケージ
RUN yum --enablerepo=remi-php71 -y install php php-mbstring php-pear php-opcache php-fpm php-pdo php-intl php-gd php-devel php-pecl-xdebug php-phpunit-PHPUnit php-mysql phpMyAdmin php-mcrypt

# php.ini編集
RUN sed -i -e 's/;date.timezone =/date.timezone = Asia\/Tokyo/' /etc/php.ini
RUN sed -i -e 's/display_errors = Off/display_errors = On/' /etc/php.ini
RUN sed -i -e 's/post_max_size = 8M/post_max_size = 100M/' /etc/php.ini
RUN sed -i -e 's/upload_max_filesize = 2M/upload_max_filesize = 100M/' /etc/php.ini
RUN sed -i -e 's/;mbstring.language = Japanese/mbstring.language = Japanese/' /etc/php.ini
RUN sed -i -e 's/;mbstring.internal_encoding = EUC-JP/mbstring.internal_encoding = UTF-8/' /etc/php.ini
RUN sed -i -e 's/;mbstring.http_input = auto/mbstring.http_input = pass/' /etc/php.ini
RUN sed -i -e 's/;mbstring.http_output = SJIS/mbstring.http_output = pass/' /etc/php.ini
RUN sed -i -e 's/;mbstring.encoding_translation = Off/mbstring.encoding_translation = Off/' /etc/php.ini

# RUN sed -i -e 's/pdo_mysql.default_socket=/pdo_mysql.default_socket= \/tmp\/mysql.sock/' /etc/php.ini
# RUN sed -i -e 's/mysql.default_socket =/mysql.default_socket = \/tmp\/mysql.sock/' /etc/php.ini
# RUN sed -i -e 's/mysqli.default_socket =/mysqli.default_socket = \/tmp\/mysql.sock/' /etc/php.ini

RUN sed -i -e 's/pdo_mysql.default_socket=/pdo_mysql.default_socket = \/var\/lib\/mysql\/mysql.sock/' /etc/php.ini
RUN sed -i -e 's/mysql.default_socket =/mysql.default_socket = \/var\/lib\/mysql\/mysql.sock/' /etc/php.ini
RUN sed -i -e 's/mysqli.default_socket =/mysqli.default_socket = \/var\/lib\/mysql\/mysql.sock/' /etc/php.ini

# グループ編集
RUN groupmod -g 1000 apache
RUN usermod -u 1000 apache

# Composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN yum -y install nasm libpng-devel

# npm, nodejs
RUN yum -y install npm nodejs

# gulp
RUN npm install gulp -g

# bower
# RUN npm install bower -g

# xdebugの設定を追加
RUN printf "xdebug.max_nesting_level = 1000\n\
xdebug.var_display_max_depth = 3\n" >> /etc/php.d/xdebug.ini

EXPOSE 80

ENTRYPOINT ["/usr/sbin/apachectl"]
WORKDIR /var/www/html

RUN npm install
RUN npm run watch
RUN composer instsall
RUN php artisan migrate:fresh --seed

CMD ["-DFOREGROUND"]
