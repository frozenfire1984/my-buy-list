<?php


interface ItemsSource {
    public function getItems(): array;
}

class Database implements ItemsSource {
    public function getItems(): array {
        return ['Молоко', 'Хлеб', 'Масло', 'Вода'];
    }
}

class FakeDatabase implements ItemsSource {
    public function getItems(): array {
        return ['lorem', 'ipsum', 'dolor'];
    }
}

class ShopController {
    public function index(ItemsSource $source): void {
        /*$db = new Database(); // сам создал внутри
        $items = $db->getItems();
        foreach ($items as $item) {
            echo $item . PHP_EOL;
        }*/

        $items = $source->getItems();

        foreach ($items as $el) {
            echo $el . PHP_EOL;
        }

    }
}

$controller = new ShopController();

$db = new Database();

$test_db = new FakeDatabase();


//print_r($items);

$controller->index($test_db);

?>
