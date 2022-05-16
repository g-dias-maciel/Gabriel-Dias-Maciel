<?php

class UserController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function list_action($params)
    {
        //check if method is correct
        $this->checkMethod('GET');

        $userModel = new UserModel();
        //if id is set get specific book, else get all
        if (isset($params['id'])) {
            $id = $params['id'];
            $responseData = $this->tryMethod($userModel, 'getUser', $id);
        } else {
            $responseData = $this->tryMethod($userModel, 'getUsers');
        }

        $this->sendResponseOK(json_encode($responseData, JSON_PRETTY_PRINT));
    }
}