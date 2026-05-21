# TODO / Learning Plan

## Следующий урок
- [ ] Супер-админ — колонка is_admin в users, Gate::before() для обхода всех проверок
- [ ] Policy — рефакторинг Gate на отдельный класс ItemPolicy (php artisan make:policy ItemPolicy --model=Item)
- [ ] Slug — человекочитаемые URL (`/items/iphone-15-pro/details` вместо `/items/7/details`)

## Скоро
- [ ] Email уведомления — MAIL_MAILER=log, письмо при claim товара через claimBy() на модели
- [ ] Сортировка по вычисляемому полю (status) — sortBy() на коллекции в PHP, трейдоф vs SQL сортировки
- [ ] Скрытие товаров — поле is_hidden, только владелец и супер-админ видят скрытые
- [ ] Супер-админские категории — категории которые может создавать/редактировать только супер-админ
- [ ] Scope на модели — scopeVisible() и подобные, инкапсуляция условий запроса. Первым делом вынести монстра из BuyListController::index() (строка 51) — `->where(fn($q) => $q->whereNull('category_id')->orWhereHas('category', ...))` — в scopeVisibleCategories() на модели Item
- [ ] Методы на модели — вынести claim, hide и др. в Item, "толстая модель, тонкий контроллер", единообразие важнее размера метода
- [ ] HTTP коды ответов и заголовки — разобраться детально
- [ ] Тестирование (Feature tests) — например тест "юзер не может редактировать чужой товар"

## Новые сущности (проектирование)
- [ ] API для React/Vue фронта + CORS
- [ ] Списки покупок (`List` hasMany `Item`)
- [ ] Магазины (`Shop`) — список может быть привязан к магазину (nullable)
- [ ] Справочник товаров (`CatalogItem`) — часто используемые товары
- [ ] Кастомные товары в списке — либо из справочника, либо своё название
- [ ] Крон-команда — раз в сутки переносить популярные кастомные товары в справочник

## Пройдено
- [x] Роутинг, контроллеры, Blade-шаблоны
- [x] Миграции, Eloquent модели
- [x] CRUD (create, store, edit, update, destroy, show)
- [x] Валидация, flash-сообщения, PRG паттерн
- [x] Relationships (hasMany / belongsTo) — Category <-> Item
- [x] N+1 проблема, Eager Loading
- [x] Логирование (Log::, DB::listen)
- [x] Исключения — Ignition, APP_DEBUG, кастомные страницы ошибок (404, 405, 500)
- [x] bootstrap/app.php — точки входа, withRouting, withExceptions
- [x] Artisan-команды, крон
- [x] Named Routes — именованные роуты, route() хелпер
- [x] user_id в items — миграция с foreignId, связи User hasMany Item / Item belongsTo User
- [x] Gates — Gate::define() в AppServiceProvider, Gate::authorize() в контроллере
- [x] Авторизация на уровне объектов — юзер видит/редактирует/удаляет только свои товары
- [x] Session hijacking — теория, почему user_id нельзя брать из request
- [x] fetch() DELETE из DevTools — как дёрнуть любой HTTP метод напрямую, CSRF-токен
- [x] Gate на show() — view-item gate, ?User nullable для гостей, short-circuit evaluation в ||
- [x] middleware('auth') на show — понял разницу: middleware перехватывает до Gate, редирект на логин
- [x] Ничейные товары — $item->user_id === null || $user?->id === $item->user_id
- [x] Gate::allows() vs Gate::authorize() — разница, когда что использовать
- [x] @can / @auth в Blade — показ элементов в зависимости от прав
- [x] Явный код vs неявный — if/else для разных выборок (авторизован / гость)
- [x] auth()->user() вместо User::find(auth()->id()) — без лишнего SQL-запроса
- [x] Prepared statements в логах — почему в SQL видно ? вместо реального значения
