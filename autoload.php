<?php
@include __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function( $class ){
  $namespace = 'Wukka\ShortCircuit';
  if( $class == $namespace || strpos( $class, $namespace . '\\') === 0 ){
     require __DIR__ . '/lib/' . str_replace('\\', '/', $class) . '.php';
  }
});