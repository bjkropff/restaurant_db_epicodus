<?php
    class Cuisine
    {
        private $id;
        private $food_type;

        function __construct($id = null, $food_type)
        {
            $this->id = $id;
            $this->food_type = $food_type;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function setFoodType($new_food_type)
        {
            $this->food_type = $new_food_type;
        }

        function getId()
        {
            return $this->id;
        }

        function getFoodType()
        {
            return $this->food_type;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO cuisine (type_of_food) VALUES ('{$this->getFoodType()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

    }
?>
