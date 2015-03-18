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

        static function getAll()
        {
            $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");

            $cuisines = array();
            foreach ($returned_cuisines as $cuisine) {
                $id = $cuisine['id'];
                $food_type = $cuisine['type_of_food'];  //LAST CHANGE
                $new_cuisine = new Cuisine($id, $food_type);
                array_push($cuisines, $new_cuisine);
            }
            return $cuisines;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisine *;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if($cuisine_id == $search_id) {
                    $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

    }
?>
