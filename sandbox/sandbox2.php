<?php



class Database {
    /*public function getItems(): array {
        return ['Молоко', 'Хлеб', 'Масло', 'Вода'];
    }*/

    public function getElements(): array { /* специально переименовал getItems в getElements */
        return ['Молоко', 'Хлеб', 'Масло', 'Вода'];
    }
}



class ShopController {
    public function index($source): void {
        try {
            /*if (!method_exists($source, 'getItems')) {
                throw new Exception("source method error!");
            }*/

            //$source->getItems();

            $items = $source->getItems();
            foreach ($items as $el) {
                echo $el . PHP_EOL;
            }

        } catch(Throwable $e) {
            echo "Error: source method error!";
        }
    }
}

$controller = new ShopController();

$db = new Database();

$controller->index($db);

?>
