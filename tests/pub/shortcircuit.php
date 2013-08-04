<?php
include __DIR__ . '/../../autoload.php';

use Wukka\ShortCircuit;
use Wukka\ShortCircuit\Resolver;
use Wukka\ShortCircuit\PatternResolver;

$patterns = array(
'/go/(id)/'                 => 'nested/test',
'/foo/bar/(a)/test/(b)'     => 'nested/deep/test',
'/idtest/(id)/'             => 'id',
'/lt/(a)/(b)/(c)'           => 'linktest',                 
);

ShortCircuit::resolver( new Resolver(__DIR__ . '/../app/', $patterns) );
ShortCircuit::run();