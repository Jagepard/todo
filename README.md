Запуск ToDo листа:
1. git clone git@github.com:Jagepard/todo.git
2. Переименовываем .env.example в .env
3. Создаем базу данных MySQL с любым названием, например todo
4. В полях: 
```
DB_DATABASE=todo
DB_USERNAME=root
DB_PASSWORD=
```
- указываем данные для подключения к базе данных
5. Выполняем команду: ```composer install```
6. Выполняем команду: ```npm install```
7. Выполняем команду: ```php artisan migrate```
8. Выполняем команду: ```php artisan key:generate```
9. Выполняем команду: ```php artisan storage:link```
10. Запускаем локальный сервер: ```php artisan serve``` и ```npm run dev```
11. Регистрируем нового пользователя по адресу: http://127.0.0.1:8000/register
12. Пользуемся ToDo листом
