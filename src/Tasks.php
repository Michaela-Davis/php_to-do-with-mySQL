<?php
class Tasks
{

    private $description;
    private $id;

    function __construct($description, $id = null)
    {
        $this->description = $description;
        $this->id = $id;
    }

    ///   description Getter and Setter   ///
    function getDescription()
    {
        return $this->description;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }



    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO tasks (description) VALUES ('{$this->getDescription()}')");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach ($returned_tasks as $task) {
            $description = $task['description'];
            $id = $task['id'];
            $new_task = new Tasks($description, $id);
            array_push($tasks, $new_task);
        }
        return $tasks;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }
}
 ?>
