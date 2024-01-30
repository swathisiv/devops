# Use an official PHP runtime as a parent image
FROM php:8.2-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY ./app/sadet-test /var/www/html

# Install any needed packages specified in requirements.txt
# For example, if using Composer for PHP dependencies:
# RUN composer install

# Install PHP extensions and other dependencies
RUN apt-get update && \
    apt-get install -y libpng-dev && \
    apt-get install libonig-dev && \
    docker-php-ext-install pdo pdo_mysql gd
#RUN docker-php-ext-install curl
RUN docker-php-ext-install ctype
#RUN docker-php-ext-install xml
RUN docker-php-ext-install mbstring

# Enable the php mod
#RUN a2enmod php8
RUN a2enmod rewrite

# Make port 80 available to the world outside this container
EXPOSE 80

# Define environment variable
#ENV NAME World

# Run app.py when the container launches
#CMD ["php", "-S", "0.0.0.0:80"]
# Start Apache when the container runs
CMD ["apache2-foreground"]
