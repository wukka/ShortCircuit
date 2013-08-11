<?php
namespace Wukka\ShortCircuit;
use Wukka\Store\Iterator as Container;
/**
 * CircuitRequest
 * @package CircuitMVC
 */
class Server extends Container implements Iface\Server
{

   /**
    * Class constructor.
    * pass in alternate to $_REQUEST
    */
    public function __construct( $data = NULL ){
        if( $data === NULL ) {
			$this->__d =& $_SERVER;
        } else {
			parent::__construct( $data );
        }
    }
}
