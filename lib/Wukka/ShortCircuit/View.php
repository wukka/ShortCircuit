<?php
namespace Wukka\ShortCircuit;
use Wukka\Store\Iterator as Container;

/**
 * Circuit View
 * @package CircuitMVC
 */
class View extends Container implements Iface\View
{
   /**
    * Render a template
    */
    public function render($name, $strict = TRUE ){
        $path = \Wukka\ShortCircuit::resolver()->get( $name, 'view' );
        if( ! $path ){
            if( $strict ) trigger_error('invalid view: ' . $name, E_USER_WARNING );
            return;
        }
        include( $path );
    }
    
    /**
    * Render a template and return it as a string
    */
    public function fetch( $name, $strict=TRUE ){
        ob_start();
        $this->render( $name, $strict );
        return ob_get_clean();
    }
    
   /**
    * used to get the request object inside of the view template files
    */
    public function request(){
        return \Wukka\ShortCircuit::request();
    }
    
    /**
    * alias method for the server object.
    */
    public function server(){
        return \Wukka\ShortCircuit::server();
    }
    
    
    /**
    * alias method for the call method.
    */
    public function call($name, $scope = NULL ){
        return \Wukka\ShortCircuit::call($name, $scope);
    }
    
    
    public function link( $name, array $params = array() ){
        return \Wukka\ShortCircuit::link( $name, $params );
    }
}
