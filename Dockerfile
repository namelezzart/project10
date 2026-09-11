FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    zip \
    unzip \
    nodejs \
    npm

# Установка расширений PHP (pdo_pgsql — проект использует Postgres)
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

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

# Порт (Render передаёт реальный порт через переменную $PORT)
EXPOSE 8080

# Запуск: прогоняем миграции и сидер при каждом старте контейнера
# (файловая система на Render эфемерная, БД может пересоздаваться),
# затем поднимаем сервер на порту, который выдал Render (или 8080 по умолчанию)
CMD php artisan migrate --seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}