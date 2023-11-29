# Единая аналитическая информационная система для малого и среднего бизнеса» 

**Ключевые функции:**
- Импорт табличных данных из Word документов(.doc, .docx) в Excel таблицы(.xlsx)
- Импорт данных из Excel таблиц в базу данных в json формате
- Фильтрация и отображение таблиц на странице
- Создание и просмотр статистики по табличным данным
- Управление пользователями и их ролями

## Установка
### Установка через docker
- `docker-compose up -d`
- Запуск npm:
  - Dev - `docker compose run --rm -p 5173:5173 node run dev`
  - Build - `docker compose run --rm node run build`
- Доступ к php и composer - `docker-compose exec php sh`
- Проект доступен по адресу localhost:8000
- По адресу localhost:8080 доступен phpmyadmin

Доступ к БД:
- Название БД - DB_DATABASE из .env
- Пользователь - DB_USERNAME из .env
- Пароль - DB_PASSWORD из .env

### Запуск проекта
1. Создать .env на основе .env.example
2. `composer install`
3. `php artisan migrate`
4. `php artisan storage:link`
5. `npm install`
6. `npm run build`

