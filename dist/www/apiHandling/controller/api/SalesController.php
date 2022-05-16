<?php

class SalesController extends BaseController
{
    /**
     * "/sales/list" Endpoint - Get list of sales
     */
    public function list_action($params)
    {
        //check if method is correct
        $this->checkMethod('GET');

        $salesModel = new SalesModel();
        //if id is set get specific book, else get all
        if (isset($params['id'])) {
            $id = $params['id'];
            $responseData = $this->tryMethod($salesModel, 'getSale', $id);
        } else {
            $responseData = $this->tryMethod($salesModel, 'getSales');
        }

        $this->sendResponseOK(json_enconde($responseData, JSON_PRETTY_PRINT));


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
        $this->checkMethod('POST');

        $post_data = json_decode(file_get_contents("php://input"));

        if ((!isset($post_data->user_id) || $post_data->user_id == "" || !is_numeric($post_data->user_id)) ||
            (!isset($post_data->book_id) || $post_data->book_id == "" || !is_numeric($post_data->book_id))
        ) {
            $this->sendError(
                "The 'user_id' or 'book_id' values are not properly defined in POST request body.",
                'HTTP/1.1 500 Internal Server Error'
            );
        }

        try {

            $salesModel = new SalesModel();
            $booksModel = new BooksModel();
            $userModel = new UserModel();

            //check if book exists in db
            if (empty($this->tryMethod($booksModel, 'getBook', $post_data->book_id))) {
                throw new Error('Book not found! Please check your Book ID!');
            }
            //check if user exists in db
            if (empty($this->tryMethod($userModel, 'getUser', $post_data->user_id))) {
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
            $this->sendError(
                $e->getMessage() . ' Something went wrong! Please contact support.',
                'HTTP/1.1 500 Internal Server Error'
            );
        }

        $this->sendResponseOK($responseData);

    }


}