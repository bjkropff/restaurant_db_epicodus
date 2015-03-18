<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $DB = new PDO('pgsql:host=localhost;dbname=test_places_to_eat');

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

        function test_getCuisineId()
        {
            //Arrange
            $food_type = "Ramen Food";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $name = "McDonalds";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getCuisineId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_setId()
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
            $test_restaurant->setId(2);

            //Assert
            $result = $test_restaurant->getId();

            $this->assertEquals(2, $result);
        }

        function test_setName()
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
            $test_restaurant->setName("Bob's Burgers");

            //Assert
            $result = $test_restaurant->getName();

            $this->assertEquals("Bob's Burgers", $result);
        }


        function test_getName()
        {
            //Arrange
            $food_type = "Fast Food";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $name = "McDonalds";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $name, $cuisine_id);

            //Act
            $result = $test_restaurant->getName();

            //Assert
            $this->assertEquals("McDonalds", $result);
        }


        function test_save()
        {
            //Arrange
            $food_type = "Fast Food";
            $id = null;
            $test_cuisine = new Cuisine($food_type, $id);
            $test_cuisine->save();

            $name = "Taco Bell";
            $cuisine_id = $test_cuisine->getId();
            $test_restaurant = new Restaurant($id, $name, $cuisine_id);

            //Act
            $test_restaurant->save();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals($test_restaurant, $result[0]);
        }

    }

?>
