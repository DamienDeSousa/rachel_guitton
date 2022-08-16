FROM php:8.1.8-apache-bullseye

RUN mkdir -p /var/www/sulu.lo/
WORKDIR /var/www/sulu.lo

COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer
COPY --from=node:16.16.0 /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node:16.16.0 /usr/local/bin/node /usr/local/bin/node

#nodejs
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

RUN apt-get update -qq && \
    apt-get install -qy \
    git \
    gnupg \
    unzip \
    zip \
    libzip-dev \
    imagemagick \
    libmagickwand-dev \
    chromium \
    wget \
    libgconf-2-4

RUN pecl install imagick xdebug && docker-php-ext-enable imagick xdebug

RUN docker-php-ext-install opcache pdo_mysql gd intl zip

# Apache
COPY my-httpd.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

# install chromedriver
ENV CHROMEDRIVER_DIR /chromedriver
RUN mkdir $CHROMEDRIVER_DIR
ENV CHROMEDRIVER_VERSION 104.0.5112.79

# Download and install Chromedriver
RUN wget -q --continue -P $CHROMEDRIVER_DIR "http://chromedriver.storage.googleapis.com/$CHROMEDRIVER_VERSION/chromedriver_linux64.zip"
RUN unzip $CHROMEDRIVER_DIR/chromedriver* -d $CHROMEDRIVER_DIR

# Put Chromedriver into the PATH
ENV PATH $CHROMEDRIVER_DIR:$PATH

# panther for E2E tests
ENV PANTHER_NO_SANDBOX 1
ENV PANTHER_CHROME_ARGUMENTS='--disable-dev-shm-usage'

CMD ["apache2-foreground"]
