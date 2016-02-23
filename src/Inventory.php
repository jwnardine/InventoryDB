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
        $items = Inventory::getAll();
        // var_dump("ALL ITEMS");
        // var_dump($item_found);
            $search_found = null;
            foreach($items as $item) {
                // var_dump($item);
                $item_name = $item->getDescription();
                // preg_match_all("/blue garfield/", $item_name, $matches);
                // preg_match_all("/^.*?($search_name)?(.*)/i", $item_name, $matches);
                // // var_dump("MATCHES:");
                // var_dump($matches);
                if ($item_name == $search_name) {
                    $search_found = $item_name;
                }
            }
            return $search_found;
    }
}
?>
