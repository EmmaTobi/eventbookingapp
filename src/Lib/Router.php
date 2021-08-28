<?php namespace App\Lib;

class Router
{
    /**
     * Get Request Method Matcher
     * @param string $route
     * @param closure $callback
     * @return void
     */
    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }
        self::on($route, $callback);
    }

    /**
     * Post Request Method Matcher
     * @param string $route
     * @param closure $callback
     * @return void
     */
    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }
        self::on($route, $callback);
    }

    /**
     * Request Method callback
     * @param string $regex
     * @param closure $cb
     * @return void
     */
    public static function on($regex, $cb)
    {
        $params = $_SERVER['REQUEST_URI'];
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);
        $queries = array();
        parse_str(isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '', $queries);
        if ($is_match) {
            // first value is normally the route, lets remove it
            array_shift($matches);
            // Get the matches as parameters
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);
        }
        $cb(new Request($params, $queries), new Response());
    }
}