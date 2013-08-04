<?php
namespace Wukka\ShortCircuit;
use Wukka\Store\Iterator as Container;

class Input extends Container
{  
    protected $_filter;
    
    public function get( $key, $filter = 'safe', $default = NULL ){
        if( is_array( $key ) ){
            $res = array();
            foreach( parent::get($key) as $k =>$v ){
                $v = $this->filter( $v, $filter );
                if( $v === NULL ) $v = $default;
                if( $v === NULL ) continue;
                $res[ $k ] = $v;
            }
            if( $default !== NULL ){
                foreach( $key as $k ){
                    if( ! isset( $res[ $k ] ) ) $res[ $k ] = $default;
                }
            }
            return $res;
        }
        $v = $this->filter( parent::get( $key ), $filter );
        if( $v === NULL ) $v = $default;
        return $v;

    }
    
    public function filter( $input, $method = 'safe'){
        if( ! isset( $this->_filter ) ) return Filter::against($input, $method);
        $filter = $this->_filter;
        return $filter( $input, $method );
    }
    
    public function attachFilter( \Closure $filter ){
        $this->_filter = $filter;
    }
    
    public function __call( $filter, $args ){
        $key = $args[0];
        $default = isset( $args[1] ) ? $args[1] : NULL;
        return $this->get( $key, $filter, $default );
    }
}
