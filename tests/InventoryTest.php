<?php

/**
   * @backupGlobals disabled
   * @backupStaticAttributes disabled
   */

require_once "src/Inventory.php";

$server = 'mysql:host=localhost;dbname=inventory';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class InventoryTest extends PHPUnit_Framework_TestCase {

    protected function tearDown()
            {
                Inventory::deleteAll();
            }


    function test_save()
            {
                //Arrange
                $description = "Darth Vader";
                $test_item = new Inventory($description);

                //Act
                $test_item->save();

                //Assert
                $result = Inventory::getAll();
                $this->assertEquals($test_item, $result[0]);
            }

    function test_getAll()
    {
        //arrange
        $description = "Dino pez";
        $description2 = "Scooby Doo";
        $test_item = new Inventory($description);
        $test_item->save();
        $test_item2 = new Inventory($description2);
        $test_item2->save();

        //act
        $result = Inventory::getAll();

        //assert
        $this->assertEquals([$test_item, $test_item2], $result);
    }

    function test_deleteAll()
        {
            //Arrange
            $description = "Dino pez";
            $description2 = "Scooby Doo";
            $test_item = new Inventory($description);
            $test_item->save();
            $test_item2 = new Inventory($description2);
            $test_item2->save();

            //Act
            Inventory::deleteAll();

            //Assert
            $result = Inventory::getAll();
            $this->assertEquals([], $result);
        }

        function test_find() {

            //arrange
            $description = "Casper";
            $test_item = new Inventory($description);
            $test_item->save();

            //act
            $result = $test_item->find($description);

            //assert
            $this->assertEquals("Casper", $result);
        }
}
 ?>
