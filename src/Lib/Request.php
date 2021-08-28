<?php namespace App\Lib;

class Request
{
    /**
     * @var array
     */
    public $params;
    /**
     * @var array
     */
    public $queries;
    /**
     * @var string
     */
    public $reqMethod;
    /**
     * @var string
     */
    public $contentType;

    public function __construct($params = [], $queries = [])
    {
        $this->params = $params;
        $this->queries = $queries;
        $this->reqMethod = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
    }

    /**
     * Get Request Body
     * @return array
     */
    public function getBody()
    {
        if ($this->reqMethod !== 'POST') {
            return '';
        }

        $body = [];
        foreach ($_POST as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }

    /**
     * Get Request Body in JSON format
     * @return array
     */
    public function getJSON()
    {
        if ($this->reqMethod !== 'POST') {
            return [];
        }

        if (strcasecmp($this->contentType, 'application/json') !== 0) {
            return [];
        }

        // Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content);

        return $decoded;
    }
}