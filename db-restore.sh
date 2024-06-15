#!/bin/bash

# Переменные для подключения к базе данных
DB_HOST="mysql"
DB_USER="root"
DB_PASSWORD="root"
DB_NAME="flowers_shop"
BACKUP_FILE="flowersshop.sql"

# Восстановление базы данных из резервной копии
echo "Восстановление базы данных $DB_NAME из файла $BACKUP_FILE..."
docker-compose exec -T mysql mysql -u$DB_USER -p$DB_PASSWORD -e "DROP DATABASE IF EXISTS $DB_NAME; CREATE DATABASE $DB_NAME CHARACTER SET utf8 COLLATE utf8_general_ci;"
docker-compose exec -T mysql mysql -u$DB_USER -p$DB_PASSWORD $DB_NAME < $BACKUP_FILE

if [ $? -eq 0 ]; then
  echo "База данных успешно восстановлена из резервной копии: $BACKUP_FILE"
else
  echo "Ошибка при восстановлении базы данных"
fi
