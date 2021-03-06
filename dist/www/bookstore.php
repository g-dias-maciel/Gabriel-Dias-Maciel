<?php
require "./inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

//rest API endpoints
if (isset($uri[2]) && $uri[2] == 'user' && isset($uri[3])){

    require PROJECT_ROOT_PATH . "./apiHandling/controller/api/UserController.php";
    $objFeedController = new UserController();


}elseif (isset($uri[2]) && $uri[2] == 'books' && isset($uri[3])){

    require PROJECT_ROOT_PATH . "./apiHandling/controller/api/BookController.php";
    $objFeedController = new BookController();

}elseif (isset($uri[2]) && $uri[2] == 'sales' && isset($uri[3])){

    require PROJECT_ROOT_PATH . "./apiHandling/controller/api/SalesController.php";
    $objFeedController = new SalesController();

}else{
    header("HTTP/1.1 404 Not Found");
    exit();
}

$arrQueryStringParams = getQueryStringParams();

//method selector
$strMethodName = $uri[3] . '_action';
$objFeedController->{$strMethodName}($arrQueryStringParams);



/**
 * Get querystring params.
 *
 * @return array
 */
function getQueryStringParams()
{
    parse_str($_SERVER['QUERY_STRING'], $query);

    return $query;
}
?>