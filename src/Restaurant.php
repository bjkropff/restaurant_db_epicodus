<?php

    require_once "Cuisine.php";

    class Restaurant
    {
        private $id;
        private $name;
        private $cuisine_id;

        function __construct($id = null, $name, $cuisine_id)
        {
            $this->id = $id;
            $this->name = $name;
            $this->cuisine_id = $cuisine_id;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setCuisineId($new_cuisine_id)
        {
            $this->cuisine_id = $new_cuisine_id;
        }

        function getId()
        {
            return $this->id;
        }

        function getName()
        {
            return $this->name;
        }

        function getCuisineId()
        {
            return $this->cuisine_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO restaurants (name, cuisine_id) VALUES ('{$this->getName()}', {$this->getCuisineId()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

    }

?>
