Route::resource('items', ItemController::class);
                                                                                                                                                                                                                                     
  Таблица роутов  

  ┌───────────┬────────────────────┬────────────┬───────────────┬──────────────────────┐                                                                                                                                             
  │   Метод   │        URL         │ Контроллер │   Имя роута   │      Назначение      │
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤                                                                                                                                             
  │ GET       │ /items             │ index()    │ items.index   │ Список               │
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤
  │ GET       │ /items/create      │ create()   │ items.create  │ Форма создания       │                                                                                                                                             
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤
  │ POST      │ /items             │ store()    │ items.store   │ Сохранить новый      │                                                                                                                                             
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤                                                                                                                                             
  │ GET       │ /items/{item}      │ show()     │ items.show    │ Детали одного        │
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤                                                                                                                                             
  │ GET       │ /items/{item}/edit │ edit()     │ items.edit    │ Форма редактирования │
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤                                                                                                                                             
  │ PUT/PATCH │ /items/{item}      │ update()   │ items.update  │ Сохранить изменения  │
  ├───────────┼────────────────────┼────────────┼───────────────┼──────────────────────┤                                                                                                                                             
  │ DELETE    │ /items/{item}      │ destroy()  │ items.destroy │ Удалить              │
  └───────────┴────────────────────┴────────────┴───────────────┴──────────────────────┘                                                                                                                                             
                  
  Именованные роуты в Blade                                                                                                                                                                                                          
   
  <a href="{{ route('items.index') }}">Список</a>                                                                                                                                                                                    
  <a href="{{ route('items.create') }}">Добавить</a>
  <a href="{{ route('items.show', $item->id) }}">Детали</a>                                                                                                                                                                          
  <a href="{{ route('items.edit', $item->id) }}">Редактировать</a>
                                                                                                                                                                                                                                     
  DELETE и PUT — через скрытое поле                                                                                                                                                                                                  
                                                                                                                                                                                                                                     
  HTML-формы поддерживают только GET и POST, поэтому Laravel использует хак:                                                                                                                                                         
                  
  {{-- Удаление --}}                                                                                                                                                                                                                 
  <form method="POST" action="{{ route('items.destroy', $item->id) }}">                                                                                                                                                              
      @csrf
      @method('DELETE')                                                                                                                                                                                                              
      <button type="submit">Удалить</button>                                                                                                                                                                                         
  </form>
                                                                                                                                                                                                                                     
  {{-- Редактирование --}}
  <form method="POST" action="{{ route('items.update', $item->id) }}">
      @csrf                                                                                                                                                                                                                          
      @method('PUT')
      ...                                                                                                                                                                                                                            
  </form>         

  Только нужные методы

  // Только эти
  Route::resource('items', ItemController::class)->only(['index', 'show']);                                                                                                                                                          
   
  // Все кроме этих                                                                                                                                                                                                                  
  Route::resource('items', ItemController::class)->except(['destroy']);
                                                                                                                                                                                                                                     
  Создать контроллер сразу со всеми методами                                                                                                                                                                                         
   
  php artisan make:controller ItemController --resource      
