<?php
namespace Wukka\ShortCircuit;
use Wukka\Store\Iterator as Container;
/**
 * CircuitRequest
 * @package CircuitMVC
 */
class Request extends Container implements Iface\Request
{

    private $args = array();
    
    private $uri = '/';
    
    private $action = '';
    
    private $base = '';

   /**
    * Class constructor.
    * pass in alternate to $_REQUEST
    */
    public function __construct( $data = NULL ){
        if( $data === NULL ) $data = $_REQUEST;
        parent::__construct( $data );
        $trim_chars = "/\n\r\0\t\x0B ";
        $server = \Wukka\ShortCircuit::server();
        $this->uri = '/' . trim($server->REQUEST_URI, $trim_chars);
        if (isset($this->{'_'})) {
            $action = $this->{'_'};
        } elseif (isset($server->PATH_INFO)) {
            $action = $server->PATH_INFO;
        }
        else {
            $pos = strpos($this->uri, '?');
            $action =( $pos === FALSE ) ? 
                $this->uri : substr($this->uri , 0, $pos);
        }
        $script_name = $server->SCRIPT_NAME;
        $action = str_replace(array($script_name, $script_name.'?_='), '', $action);
        $action = trim($action, $trim_chars);
        $this->action = '/' . $action;
        if (strpos($this->uri, $script_name) === 0) {
            $this->base = $script_name;
        } else {
            $this->base = '';
        }
    }
    
    /**
    * grab the action set in the constructor
    */
    public function action(){
        return $this->action;
    }
    
  /**
    * grab the uri set in the constructor
    */
    public function uri(){
        return $this->uri;
    }
    
    public function base(){
        return $this->base;
    }
}
