<?php

class BookController extends BaseController
{
    /**
     * "/books/list" Endpoint - Get list of books
     */
    public function list_action()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $booksModel = new BooksModel();

                //if id is set get specific book, else get all
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $userid = $arrQueryStringParams['id'];
                    $arrBooks = $booksModel->getBook($userid);
                }else{
                    $arrBooks = $booksModel->getBooks();
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



}