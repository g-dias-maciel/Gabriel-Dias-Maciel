<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class BooksModel extends Database
{

    /**
     * get book from id
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function getBook($id)
    {
        return $this->select("SELECT * FROM books WHERE book_id = $id");
    }

    /**
     * get all books
     * @return mixed
     * @throws Exception
     */
    public function getBooks()
    {
        return $this->select("SELECT * FROM books ORDER BY book_id ASC");
    }
}