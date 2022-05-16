<?php

class BookController extends BaseController
{
    /**
     * "/books/list" Endpoint - Get list of books
     */
    public function list_action($params)
    {
        //check if method is correct
        $this->checkMethod('GET');

        $booksModel = new BooksModel();
        //if id is set get specific book, else get all
        if (isset($params['id'])) {
            $id = $params['id'];
            $responseData = $this->tryMethod($booksModel, 'getBook', $id);
        } else {
            $responseData = $this->tryMethod($booksModel, 'getBooks');
        }

        $this->sendResponseOK(json_encode($responseData, JSON_PRETTY_PRINT));

    }



}