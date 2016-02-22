<?php
class Inventory  {
    private $description;

    function __construct($description)
    {
        $this->description = $description;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO items (description) VALUES ('{$this->getDescription()}');");
    }

    static function getAll()
    {
    $returned_items = $GLOBALS['DB']->query("SELECT * FROM items;");
    $items = array();
    foreach($returned_items as $item) {
        $description = $item['description'];
        $new_item = new Inventory($description);
        array_push($items, $new_item);
    }
    return $items;
    }

    static function deleteAll()
    {
       $GLOBALS['DB']->exec("DELETE FROM items;");
    }

    static function find($search_name) {
        // $item_found = $GLOBALS['DB']->query("SELECT * FROM items WHERE description LIKE '$search_name'");
        $item_found = Inventory::getAll();
            foreach($item_found as $item) {
                $item_name = $item->getDescription();
                if ($item_name == $search_name) {
                return $item_name;
                }
                else {
                    return "Item not found";
                }
            }
    }
}
?>
