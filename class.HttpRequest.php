<?php
// Load support classes
require_once 'class.SimpleHtmlDom.php';
/**
 * PHP Httprequest
 *
 * @package Httprequest
 * @author  phutv <jupro123@gmail.com>
 * @access  public
 */
class Httprequest {

    /**
     * [__construct create enviroment]
     */
    function __construct() {

    }

    /**
     * server
     *
     * @var string
     */

    private $server;

    /**
     * setServer
     *
     * @param unknown $value
     * @return void
     */

    public function setServer( $value ) {

        $this->server = $value;

    }

    /**
     * getServer
     *
     * @return string
     */

    public function getServer() {

        return $this->server;

    }

    /**
     * params
     *
     * @var string
     */

    private $params = array();

    /**
     * setParams
     *
     * @param unknown $value
     * @return void
     */

    public function setParams( $value ) {

        $this->params = $value;

    }

    /**
     * getParams
     *
     * @return string
     */

    public function getParams() {

        return $this->params;

    }

    /**
     * options
     *
     * @var string
     */

    private $options;

    /**
     * setOptions
     *
     * @param unknown $value
     * @return void
     */

    public function setOptions( $value ) {

        $this->options = $value;

    }

    /**
     * getOptions
     *
     * @return string
     */

    public function getOptions() {

        return $this->options;

    }

    /**
     * method
     *
     * @var string
     */

    private $method;

    /**
     * setMethod
     *
     * @param unknown $value
     * @return void
     */

    public function setMethod( $value ) {

        $this->method = $value;

    }

    /**
     * getMethod
     *
     * @return string
     */

    public function getMethod() {

        return $this->method;

    }

    /**
     * action
     *
     * @var string
     */

    private $action;

    /**
     * setAction
     *
     * @param unknown $value
     * @return void
     */

    public function setAction( $value ) {

        $this->action = $value;

    }

    /**
     * getAction
     *
     * @return string
     */

    public function getAction() {

        return $this->action;

    }

    /**
     * content-type
     *
     * @var string
     */

    private $contentType = "application/x-www-form-urlencoded";

    /**
     * setAction
     *
     * @param unknown $value
     * @return void
     */

    public function setContentType( $value ) {

        $this->contentType = $value;

    }

    /**
     * pattern
     *
     * @var pattern
     */
    private $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";

    function validURL()
    {
        $url = $this->server.'/'.$this->action;
        $pattern = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        preg_match($this->pattern, $url, $matches);
        if ($matches) {
            return true;
        }
        else{
            return false;
        }
    }

    public function send() {

        $url = $this->server.'/'.$this->action;

        // use key 'http' even if you send the request to https://...
        $this->options = array(
            'http' => array(
                'header'  => "Content-type: ".$this->contentType."\r\n",
                'method'  => $this->method,
                'content' => http_build_query( @$this->params ),
            ),
        );

        $context  = stream_context_create( $this->options );

        if ($this->validURL()) {

            $result = file_get_html( $url, false, $context );

        }
        else {

            $result = (object) array(
                'error' => 1,
                'message' => 'Invalid URL Request'
            );

        }

        return $result;

    }

    
    function parseHeaders($headers)
    {
        $head = array();

        foreach($headers as $k => $v) {

            $t = explode(':', $v, 2);

            if (isset($t[1]))

                $head[trim($t[0])] = trim($t[1]);

            else {

                $head[] = $v;

                if (preg_match("#HTTP/[0-9\.]+\s+([0-9]+)#", $v, $out)) {

                    $head['reponse_code'] = intval($out[1]);

                }

            }

        }

        return $head;

    }

}

?>