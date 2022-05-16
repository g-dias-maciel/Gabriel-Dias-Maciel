<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "apiHandling/controller/api/BaseController.php";

// include the user/books model file
require_once PROJECT_ROOT_PATH . "/apiHandling/model/UserModel.php";
require_once PROJECT_ROOT_PATH . "/apiHandling/model/BooksModel.php";
require_once PROJECT_ROOT_PATH . "/apiHandling/model/SalesModel.php";
?>