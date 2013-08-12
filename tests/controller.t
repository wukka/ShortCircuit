#!/usr/bin/env php
<?php
include_once __DIR__ . '/../autoload.php';
use Wukka\Test as T;
use Wukka\ShortCircuit;
use Wukka\ShortCircuit\Resolver;
use Wukka\ShortCircuit\Controller;
use Wukka\Shortcircuit\Request;
T::plan(4);

ShortCircuit::resolver( new Resolver( __DIR__ . '/app/' ) );

$c = new Controller();
$res = $c->execute('test');
T::is( $res, array('test'=>'123'), 'ran an action, got back results');
$res = $c->execute('nested/test');
T::is( $res, 1, 'get back 1 on an empty action');
$r = ShortCircuit::request();
$r->set('abc', '123');
$res = $c->execute('nested/requestmirror');
T::is( $res, array('abc'=>'123'), 'requestmirror action returned the var we mapped into the request');

$res = $c->call('test', array('payload'=>$num = mt_rand(1, 1000) ) );
T::is( $res, array('response'=>$num), 'made an api call from the controller');
