TASK 1

- run 'jsonFormat_task_1.php' on 'php' docker container to print the json information into console as a table
   . JSON files are included on ./data/json_files and were generated via the script jsonCreateFiles.php
   . JSON functions are included on ./app/methods/jsonController.php



TASK 2

- run phpunit './unitest/arrayControllerTest.php' on 'php' docker container to execute the unitests for the array search
  algorithm.
    . array functions are included on ./app/methods/arrayController.php


TASK 3

- A Postman collection is included on ./data/api/ there all the endpoints are configured
    . api controller files are included on ./controller/api/
    . database controller files are included on ./model
    . database mockup data should be started on the command 'docker-compose up --build' if not the files are included on
    database/*.sql
    . api start point is the file 'bookstore.php'