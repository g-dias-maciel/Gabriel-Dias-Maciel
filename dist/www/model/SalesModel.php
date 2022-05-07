<?php
require_once PROJECT_ROOT_PATH . "/model/Database.php";

class SalesModel extends Database
{
    /**
     * inser new value to sales table
     *
     * @param $book_id
     * @param $user_id
     * @return int
     * @throws Exception
     */
    public function addSale($book_id, $user_id)
    {

        return $this->insert("INSERT INTO sales (book_id, user_id) VALUES ($book_id, $user_id)");
    }

    /**
     * get specified value from sales table
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function getSale($id)
    {
        return $this->select("SELECT * FROM sales WHERE sales_id=$id");
    }

    /**
     *  get all values from sales table
     * @return mixed
     * @throws Exception
     */
    public function getSales()
    {
        return $this->select("SELECT * FROM sales ORDER BY sales_id ASC");
    }
}