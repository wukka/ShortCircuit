<?php
namespace Wukka\ShortCircuit;

/**
 * Controller
 * this can be subclassed if you wish to change the default behavior of the controller.
 * To attach your new version, do: 
 *
 *    ShortCircuit::controller( new MyController );
 *
 * The class will be used when ShortCircuit::controller() is called.
 */
class Controller extends State implements Iface\Controller
{
   /**
    * call an action file.
    * this shouldn't produce any output.
    * by convention, it should return some sort of data, usually an array
    * that can be consumed by the view
    * this is mapped into the view container.
    * if strict, trigger errors if the path isn't found.
    */
    public function execute($name, $strict = TRUE ){
        $path = \Wukka\ShortCircuit::resolver()->get( $name, 'action' );
        if( ! $path ){
            if( $strict ) trigger_error('invalid action: ' . $name, E_USER_WARNING );
            return;
        }
        return include( $path );
    }
}
