<?php

class UserController extends BaseController
{
    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function list_action()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel();

                //if id is set get specific user, else get all
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $userid = $arrQueryStringParams['id'];
                    $arrUsers = $userModel->getUser($userid);
                }else{
                    $arrUsers = $userModel->getUsers();
                }

                $responseData = json_encode($arrUsers, JSON_PRETTY_PRINT);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . " Something went wrong! Please contact support.";
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