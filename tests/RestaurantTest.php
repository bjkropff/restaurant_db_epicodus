<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $DB = new PDO('pgsql:host=localhost;dbname=places_to_eat');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        // protected function tearDown()
        // {
        //     Restaurant::deleteAll();
        // }

        function test_getId()
        {
            //Arrange
            $food_type = "Fast Food";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $name = "McDonalds";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
    }

?>
