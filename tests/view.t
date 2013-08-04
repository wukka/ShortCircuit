#!/usr/bin/env php
<?php
include_once __DIR__ . '/../autoload.php';
use Wukka\Test as T;
use Wukka\ShortCircuit;
use Wukka\ShortCircuit\Resolver;
use Wukka\ShortCircuit\View;
T::plan(4);

ShortCircuit::resolver( new Resolver( __DIR__ . '/app/' ) );

$v = new View( array('test'=>'fun') );

$out = $v->fetch('test');
T::is($out, 'hello fun', 'fetched the test view correctly with the variable mapped in');

ob_start();
$v->render('test');
$out = ob_get_clean();
T::is($out, 'hello fun', 'rendered the test view correctly with the variable mapped in');
$out = $v->fetch('nested/test');
T::is($out, realpath(__DIR__ . '/app/nested/test.view.php') . ' fun', 'fetched the nested test view with the variable mapped in');
$out = $v->fetch('nested');
T::is($out, realpath(__DIR__ . '/app/nested.view.php') . ' fun', 'fetched the nested test index view');
