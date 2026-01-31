FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Установка расширений PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /app

# Копируем файлы
COPY . .

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Права доступа
RUN chmod -R 775 storage bootstrap/cache

# Порт
EXPOSE 8080

# Запуск
CMD php artisan serve --host=0.0.0.0 --port=8080