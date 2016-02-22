<?php
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



}
 ?>


<!-- if the user saves a pez dispenser, the program will show a stored pez dispenser

if the user wants to display all pez, the program will output all contents of database

if the user wants to find dinosaur pez, the program will output a response

if the user wants to delete the ronald mcdonald pez, the program will delete pez from the database -->
