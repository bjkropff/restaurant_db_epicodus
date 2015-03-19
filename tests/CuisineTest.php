<?php

    /**
    * @backupGlobals disabled
    *$backupStaticAttribute disabled
    */

    require_once "src/Cuisine.php";

    $DB = new PDO('pgsql:host=localhost;dbname=test_places_to_eat');

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $food_type = "Mexican";
            $id = 1;
            $test_Cuisine = new Cuisine($id, $food_type);

            //Act
            $result = $test_Cuisine->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_getFoodType()
        {
            //Arrange
            $food_type = "Asian";
            $id = null;
            $test_Cuisine = new Cuisine($id, $food_type);

            //Act
            $result = $test_Cuisine->getFoodType();

            //Assert
            $this->assertEquals($food_type, $result);

        }

        function test_setId()
        {
            //Arrange
            $food_type = "American";
            $id = null;
            $test_Cuisine = new Cuisine($id, $food_type);
            $test_Cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);

        }

        function test_setFoodType()
        {
            //Arrange
            $food_type = "American";
            $id = null;
            $test_Cuisine = new Cuisine($id, $food_type);
            $test_Cuisine->save();

            //Act
            $test_Cuisine->setFoodType($food_type);
            $result = $test_Cuisine->getFoodType();

            //Assert
            $this->assertEquals($food_type, $result);
        }

        function test_save()
        {
            //Arrange
            $food_type = "American";
            $id = null;
            $food_type2 = "Indian";
            $id2 = null;
            $test_Cuisine = new Cuisine($id, $food_type);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($id2, $food_type2);
            $test_Cuisine2->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_cuisineUpdate()
        {
            //Arrange
            $food_type = "American food";
            $id = 1;
            $test_Cuisine = new Cuisine($id, $food_type);
            $test_Cuisine->save();

            $new_cuisine_name = "American cuisine";

            //Act
            $test_Cuisine->update($new_cuisine_name);

            //Assert
            $this->assertEquals("American cuisine", $test_Cuisine->getFoodType());
        }

        function test_delete()
        {
            //Arrange
            $food_type = "American food";
            $id = null;
            $test_Cuisine = new Cuisine($id, $food_type);
            $test_Cuisine->save();

            $food_type2 = "Asian food";
            $test_Cuisine2 = new Cuisine($id, $food_type2);
            $test_Cuisine2->save();

            //Act
            $test_Cuisine->delete();

            //Assert
            $this->assertEquals([$test_Cuisine2], Cuisine::getAll());
        }

        function test_delete_cuisineRestaurants()
        {
            //Arrange
            $food_type = "American food";
            $id = null;
            $test_Cuisine = new Cuisine($id, $food_type);
            $test_Cuisine->save();

            $restaurant_name= "Burrito";
            $cuisine_id = $test_Cuisine->getId();
            $test_Restaurant = new Restaurant($id, $restaurant_name, $cuisine_id);
            $test_Restaurant->save();

            //Act
            $test_Cuisine->delete();

            //Assert
            $this->assertEquals([], Restaurant::getAll());
        }

    }

?>
