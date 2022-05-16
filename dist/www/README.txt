TASK 1

- run 'jsonFormat.php' on 'php' docker container to print the json information into console as a table
   . JSON files are included on ./data/json_files and were generated via the script jsonCreateFiles.php
   . JSON functions are included on dist/www/jsonHandling/class/jsonHandler.php



TASK 2

- run phpunit 'var.clean/dist/www/arrayHandling/unitest/arrayHandlerTest.php' on 'php' docker container to execute the unitests for the array search
  algorithm.
    . array functions are included on dist/www/arrayHandling/class/arrayHandler.php


TASK 3

- A Postman collection is included on "dist/www/apiHandling/data/api/bookstore.postman_collection.json" there all the endpoints are defined
    . api controller files are included on "dist/www/apiHandling/controller"
    . database controller files are included on "dist/www/apiHandling/model"
    . database mockup data should be started on the command 'docker-compose up --build' if not the files are included on
    database/*.sql
    . api start point is the file 'bookstore.php'