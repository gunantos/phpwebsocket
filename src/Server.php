<?php
namespace appkita\phpwebsocket;
use Psr\Log\LoggerInterface;

class Server {
    protected $logger;
    /**
     * @var string $host
     */
    protected $host;
    /**
     * @var int $port
     */
    protected $port;
    /**
     * @var ?string $socketPath
     */
    protected $socketPath;

    /**
     * @var array $client
     */
    protected $client = [];

    /**
     * @var array $allowOrgins
     */
    protected $allowOrgins = [];


    /**
     * @var int $maxConnection default 0 set unlimeted
     */
    protected $maxConnection = 0;

    /**
     * function construct 
     * @var string|array $host default "localhost" array set = ['host'=>'', 'port'=>'', 'socketPath'=>'', 'logger'=>null]
     */
    public function __construct($host='localhost', int $port = 8044, ?string $socketPath = '/tmp/phpwss.sock', LoggerInterface $logger = null) {
        $_h = 'localhost';
        $_p = 8044;
        $_path = '/tmp/phpwss.sock';
        $_l = null;
        if (is_array($host)) {
            if (isset($host['host']) && !empty($host['host'])) {
                $_h = $host['host'];
            }
            if (isset($host['port']) && !empty($host['port'])) {
                $_p = $host['port'];
            }
            if (isset($host['socketPath']) && !empty($host['socketPath'])) {
                $_path = $host['socketPath'];
            }
            if (isset($host['logger']) && !empty($host['logger'])) {
                $_l = $host['logger'];
            }
        } else {
            if (!empty($host)) $_h = $host;
            if (!empty($port)) $_p = $port;
            if (!empty($socketPath)) $_path = $socketPath;
            if (!empty($logger)) $_l = $logger;
        }
        $this->host = $_h;
        $this->port = $_p;
        $this->socketPath = $_path;
        $this->logger = $_l;
    }

    /**
     * Checks if the submitted origin (part of websocket handshake) is allowed
     * to connect. Allowed origins can be set at server startup.
     *
     * @param string $domain The origin-domain from websocket handshake.
     * @return bool If domain is allowed to connect method returns true.
     */
    public function checkOrigin(string $domain): bool {
        $domain = str_replace('http://', '', $domain);
        $domain = str_replace('https://', '', $domain);
        $domain = str_replace('www.', '', $domain);
        $domain = str_replace('/', '', $domain);
        return isset($this->allowOrgins[$domain]);
    }

    
}