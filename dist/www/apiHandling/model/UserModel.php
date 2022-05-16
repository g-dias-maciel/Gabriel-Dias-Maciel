<?php
require_once "Database.php";

class UserModel extends Database
{
    /**
     * get user by id
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function getUser($id)
    {
        return $this->select("SELECT * FROM users WHERE user_id = $id");
    }

    /**
     * get all users
     * @return mixed
     * @throws Exception
     */
    public function getUsers()
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC");
    }
}