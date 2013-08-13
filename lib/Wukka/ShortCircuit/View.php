<?php
namespace Wukka\ShortCircuit;

/**
 * Circuit View
 * @package CircuitMVC
 */
class View extends State implements Iface\View
{
   /**
    * Render a template
    */
    public function render($name, $strict = TRUE ){
        $path = $this->resolver()->get( $name, 'view' );
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
}
