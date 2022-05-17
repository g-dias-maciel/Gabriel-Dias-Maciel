TASK 1

########################## JSON parsing basic skills ##########################

"There is a folder with multiple JSON files that are in the same JSON format.
 Each file contains the following information: first name, last name, birthday, address, and phone number.
 Your task is to read all files and parse the data into the same person object.
 The task is to list all data in any output format you choose, which can be a console as well."

- run 'jsonFormat.php' on 'php' docker container to print the json information into console as a table
   . JSON files are included on ./data/json_files and were generated via the script jsonCreateFiles.php
   . JSON functions are included on dist/www/jsonHandling/class/jsonHandler.php



TASK 2

################################# Algorithm ###################################

"You have a sorted array (ASC) given which can contain up to 1 million integer numbers.
 Your task is to write a method returning the position of the desired number in the array,
 if not present return -1. Elements of the array are not unique, you can return the first one if multiple.
 Please provide the unit tests for different cases."


- run phpunit 'var.clean/dist/www/arrayHandling/unitest/arrayHandlerTest.php' on 'php' docker container to execute the unitests for the array search
  algorithm.
    . array functions are included on dist/www/arrayHandling/class/arrayHandler.php


TASK 3

################################ Small project #################################

"Your task is to build a small application for bookkeeping (library) including books and users.
 The functionality needed is: get all books, get all users, and purchase (book, user).
 You are free to use any storage like files, DB, or memory.
 We don’t need a frontend for this you can just create a rest API or simple console output,
 the focus is on the architecture."

- A Postman collection is included on "dist/www/apiHandling/data/api/bookstore.postman_collection.json" there all the endpoints are defined
    . api controller files are included on "dist/www/apiHandling/controller"
    . database controller files are included on "dist/www/apiHandling/model"
    . database mockup data should be started on the command 'docker-compose up --build' if not the files are included on
    database/*.sql
    . api start point is the file 'bookstore.php'