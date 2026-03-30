# Прогресс обучения Laravel

## Пройдено
- Роутинг
- Контроллеры (BuyListController)
- Blade-шаблоны (`{{ }}`, `@foreach`)
- Передача данных из контроллера в шаблон
- Миграции — таблица `items`
- SQLite + Database plugin в PhpStorm
- Eloquent модель `Item`
- Collection vs массив
- Статические методы `::` vs методы объекта `->`
- `$fillable` и защита от mass assignment
- Трейт `HasFactory`
- Seeder (`ItemSeeder`) и Factory (`ItemFactory`) с Faker
- `php artisan migrate:fresh --seed`

## Следующий шаг — CRUD
1. Добавить `Route::post('/buy-list', ...)` в `web.php`
2. Метод `store()` в `BuyListController` — сохранение нового товара
3. Форма в Blade для добавления товара
4. Удаление записи
5. Редактирование записи
