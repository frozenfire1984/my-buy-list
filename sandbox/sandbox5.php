<?php



class Database {
    public function getItems(): array {
        return ['Молоко', 'Хлеб', 'Масло', 'Вода'];
    }

    /*public function getItems() {
        return null;
    }*/

    public function getElements(): array { /* специально переименовал getItems в getElements */
        return ['Молоко', 'Хлеб', 'Масло', 'Вода'];
    }
}

class NonAnObjectException extends InvalidArgumentException {
    public function __construct() {
        parent::__construct("source is not an object!");
    }
}

class ShopController {
    public function index($source = null): void {
        try {
            if (!$source) {
                throw new InvalidArgumentException("source don't exist!");
            }

            if (!is_object($source)) {
                throw new NonAnObjectException("source is not object!");
            }

            if (!method_exists($source, 'getItems')) {
                throw new BadMethodCallException("source don't have method getItems");
            }

            $items = $source->getItems();

            if (empty($items)) {
                throw new RuntimeException("DB return empty array!");
            }

            foreach ($items as $el) {
                echo $el . PHP_EOL;
            }

        } catch(NonAnObjectException $e) {
            echo "Non Object Type Error: " . $e->getMessage() . "\nLine: " . $e->GetLine() . "\nFile: " . $e->getFile() . PHP_EOL;
        } catch(InvalidArgumentException $e) {
            echo "Invalid Argument Error: " . $e->getMessage() . "\nLine: " . $e->GetLine() . "\nFile: " . $e->getFile(). PHP_EOL;
        } catch(BadMethodCallException $e) {
            echo "Bad Method Call Error: " . $e->getMessage() . "\nLine: " . $e->GetLine() . "\nFile: " . $e->getFile(). PHP_EOL;
        } catch(LogicException $e) {
            echo "Logic Error: " . $e->getMessage() . "\nLine: " . $e->GetLine() . "\nFile: " . $e->getFile(). PHP_EOL;
        } catch(RuntimeException $e) {
            echo "Runtime Error: " . $e->getMessage() . "\nLine: " . $e->GetLine() . "\nFile: " . $e->getFile(). PHP_EOL;
        } catch(Exception $e) {
            echo "General Error: " . $e->getMessage() . "\nLine: " . $e->GetLine() . "\nFile: " . $e->getFile(). PHP_EOL;
        } finally {
            echo "executed". PHP_EOL;
        }
    }
}

$controller = new ShopController();

$db = new Database();

$fake_db = "lol";

$user = (object) [
    'id' => 1,
    'name' => 'Yurii',
    'email' => 'yurii@example.com',
    'is_active' => true,
];

$arr = ['Молоко', 'Хлеб', 'Масло', 'Вода'];

$controller->index($db);

?>
