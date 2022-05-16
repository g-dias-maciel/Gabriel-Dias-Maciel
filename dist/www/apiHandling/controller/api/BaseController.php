<?php

class BaseController
{
    /**
     * __call magic method.
     */
    public function __call($name, $arguments)
    {
        $this->sendOutput('', array('HTTP/1.1 404 Not Found'));
    }

    /**
     * Get URI elements.
     *
     * @return array
     */
    protected function getUriSegments()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        return $uri;
    }

    /**
     * Send API output.
     *
     * @param mixed $data
     * @param string $httpHeader
     */
    protected function sendOutput($data, $httpHeaders = array())
    {
        header_remove('Set-Cookie');

        if (is_array($httpHeaders) && count($httpHeaders)) {
            foreach ($httpHeaders as $httpHeader) {
                header($httpHeader);
            }
        }

        echo $data;
        exit;
    }

    /**
     * @param $class
     * @param $method
     * @param null $arg
     * @return false|string|void
     */
    protected function tryMethod($class, $method, $arg = null)
    {
        try {

            return $class->{$method}($arg);

        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            $this->sendError($strErrorDesc, $strErrorHeader);
        }
    }

    /**
     * @param $responseData
     */
    protected function sendResponseOK($responseData)
    {
        $this->sendOutput(
            $responseData,
            array('Content-Type: application/json', 'HTTP/1.1 200 OK')
        );
    }

    /**
     * @param $method
     */
    protected function checkMethod($method)
    {
        if (strtoupper($_SERVER["REQUEST_METHOD"]) !== strtoupper($method)){
            $this->sendMethodError();
        }
    }

    /**
     *
     */
    protected function sendMethodError()
    {
        $strErrorDesc = 'Method not supported';
        $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        $this->sendError($strErrorDesc, $strErrorHeader);
    }

    /**
     * @param $errorDesc
     * @param $errorHeader
     */
    protected function sendError($errorDesc, $errorHeader)
    {
        $this->sendOutput(json_encode(array('error' => $errorDesc)),
            array('Content-Type: application/json', $errorHeader)
        );
    }


}