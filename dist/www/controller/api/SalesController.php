<?php

class SalesController extends BaseController
{
    /**
     * "/sales/list" Endpoint - Get list of sales
     */
    public function list_action()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $salesModel = new SalesModel();

                //if id is set get specific sale, else get all
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $userid = $arrQueryStringParams['id'];
                    $arrBooks = $salesModel->getSale($userid);
                } else {
                    $arrBooks = $salesModel->getSales();
                }

                $responseData = json_encode($arrBooks, JSON_PRETTY_PRINT);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * /sales/add Endpoint - POST add new entry to sales table
     *
     * {
     * "user_id":"15",
     * "book_id": "510"
     * }
     *
     * @throws Exception
     */
    public function add_action()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'POST') {
            $post_data = json_decode(file_get_contents("php://input"));

            if ((!isset($post_data->user_id) || $post_data->user_id == "" || !is_numeric($post_data->user_id)) ||
                (!isset($post_data->book_id) || $post_data->book_id == "" || !is_numeric($post_data->book_id))
            ) {
                $strErrorDesc = "The 'user_id' or 'book_id' values are not properly defined in POST request body.";
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            } else {
                try {
                    $salesModel = new SalesModel();
                    $booksModel = new BooksModel();
                    $userModel = new UserModel();

                    //check if book exists in db
                    if (empty($booksModel->getBook($post_data->book_id))) {
                        throw new Error('Book not found! Please check your Book ID!');
                    }
                    //check if user exists in db
                    if (empty($userModel->getUser($post_data->user_id))) {
                        throw new Error('User not found! Please check your User ID!');
                    }
                    //insert values into sales table
                    $affected_rows = $salesModel->addSale($post_data->book_id, $post_data->user_id);

                    //if no row was affected insert failed
                    $response = [
                        'success' => ($affected_rows > 0)
                    ];

                    $responseData = json_encode($response, JSON_PRETTY_PRINT);
                } catch (Error $e) {
                    $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            }

        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }

    }


}