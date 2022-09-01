#!/usr/local/bin/php -q
<?php
class PHPWebsocket {
    private $_IP = "";
    private $_PORT = "";
    private $_sock = null;
    function __construct($ip="", $port="8080", $prod = FALSE) {
        if ($prod == true) {
            error_reporting(E_ALL);
        } else {
            error_reporting(E_NONE);
        }
        $this->_IP = $ip;
        $this->_PORT = $port;
        $this->_sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    }

    public function start() {}
}