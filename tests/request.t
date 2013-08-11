#!/usr/bin/env php
<?php
include_once __DIR__ . '/../autoload.php';
use Wukka\Test as T;
use Wukka\ShortCircuit\Request;
use Wukka\ShortCircuit\Input;
T::plan(3);

$_REQUEST = array('test'=>'1');
$r = new Request;

T::is( $r->test, 1, 'request imports $_REQUEST into a container');

$r = new Request( array('test'=>'2') );

T::is( $r->test, 2, 'request imports array into a container');

$_SERVER['REQUEST_URI'] = '/test/a/b/c?hello=1';

$r = new Request();
T::is( $r->action(), '/test/a/b/c', 'action extracted from REQUEST_URI' );
