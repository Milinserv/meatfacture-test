# meatfacture-test

## Используемые технологии

- Laravel v10
- Laravel Data
- Jwt

## Настройка БД

- Создать файл конфигурации подключения к БД
```
cp .env.example .env
```
- Создание таблиц 
```
php artisan migrate
```
- Наполнение таблицы Product продуктами
```
php artisan db:seed
```

## Запуск проекта
```
php artisan serve
```
