<?php

namespace App\Lib;

class Response
{
    private $status = 200;

    /**
     * Response status
     * @param int $code The status code
     * @return App\Lib\Response
     */
    public function status(int $code)
    {
        $this->status = $code;
        return $this;
    }
    
     /**
     * Response status
     * @param array $data response payload
     * @return void
     */
    public function toJSON($data = [])
    {
        http_response_code($this->status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}