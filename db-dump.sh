#!/bin/bash

# Переменные для подключения к базе данных
DB_HOST="mysql"
DB_USER="root"
DB_PASSWORD="root"
DB_NAME="flowers_shop"
BACKUP_DIR="/"
DATE=$(date +"%Y%m%d_%H%M%S")
BACKUP_FILE="flowersshop.sql"

# Создание резервной копии базы данных
echo "Создание дампа базы данных $DB_NAME..."
docker-compose exec mysql mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASSWORD $DB_NAME > $BACKUP_FILE

if [ $? -eq 0 ]; then
  echo "Резервная копия базы данных успешно создана: $BACKUP_FILE"
else
  echo "Ошибка при создании резервной копии базы данных"
fi
