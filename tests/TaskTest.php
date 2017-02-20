<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Tasks.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TasksTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Tasks::deleteAll();
        }

        function test_save()
        {
            ///   Arrange   ///
            $description = "Wash the dog";
            $test_task = new Tasks($description);

            ///   Act   ///
            $test_task->save();

            ///   Assert   ///
            $result = Tasks::getAll();
            $this->assertEquals($test_task, $result[0]);
        }

        function test_getAll()
        {
            ///   Arrange   ///
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Tasks($description);
            $test_task->save();
            $test_task2 = new Tasks($description2);
            $test_task2->save();

            ///   Act   ///
            $result = Tasks::getAll();

            ///   Assert   ///
            $this->assertEquals([$test_task, $test_task2], $result);
        }

        function test_deleteAll()
        {
            ///   Arrange   ///
            $description = "Wash the dog";
            $description2 = "Water the lawn";
            $test_task = new Tasks($description);
            $test_task->save();
            $test_task2 = new Tasks($description2);
            $test_task2->save();

            ///   Act   ///
            Tasks::deleteAll();

            ///   Assert   ///
            $result = Tasks::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            ///   Arrange   ///
            $description = "Wash the dog";
            $id = 1;
            $test_task = new Tasks($description, $id);

            ///   Act   ///
            $result = $test_task->getId();

            ///   Assert   ///
            $this->assertEquals(1, $result);
        }
    }

?>
