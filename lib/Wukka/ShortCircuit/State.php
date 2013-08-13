<?php
namespace Wukka\ShortCircuit;
use Wukka\Store\Iterator as Container;

/**
 * Controller
 * this can be subclassed if you wish to change the default behavior of the controller.
 * To attach your new version, do: 
 *
 *    ShortCircuit::controller( new MyController );
 *
 * The class will be used when ShortCircuit::controller() is called.
 */
class State extends Container
{

    
    /**
    * alias method for the router request object.
    */
    public function request(){
        return \Wukka\ShortCircuit::request();
    }
    
    /**
    * alias method for the router server object.
    */
    public function server(){
        return \Wukka\ShortCircuit::server();
    }
    
    /**
    * alias method for the router server object.
    */
    public function resolver(){
        return \Wukka\ShortCircuit::resolver();
    }
    
    public function link( $name, array $params = array() ){
        return $this->request()->base() . $this->resolver()->link( $name, $params );
    }
    
    /**
    * alias method for the call method.
    */
    public function call($_name, $_scope = NULL ){
       if( $_scope && is_array($_scope ))  extract( $_scope );
       return include $this->resolver()->get( $_name, 'call' );
    }
}
