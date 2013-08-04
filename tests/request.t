#!/usr/bin/env php
<?php
include_once __DIR__ . '/../autoload.php';
use Wukka\Test as T;
use Wukka\ShortCircuit\Request;
use Wukka\ShortCircuit\Input;
T::plan(10);

$_REQUEST = array('test'=>'1');
$r = new Request;

T::is( $r->test, 1, 'request imports $_REQUEST into a container');

$r = new Request( array('test'=>'2') );

T::is( $r->test, 2, 'request imports array into a container');
T::cmp_ok( $r->alpha('test', 100), '===', 100, 'applied alpha filter, got a default. original value excluded');
T::cmp_ok( $r->int('test', 100), '===', '2', 'applied int filter, got my orig. value.');

$r = new Request( array('var1'=> 'hello<script>world</script>') );

T::is( $r->var1, 'helloscriptworld/script', 'Variable is filtered by default');
T::is( $r->raw('var1'), 'hello<script>world</script>', 'can still get raw variable');
T::is( $r->get('var1', FILTER_SANITIZE_STRIPPED), 'helloworld', 'rip out tags');
T::is( $r->get('var1', array(FILTER_SANITIZE_STRING=>FILTER_FLAG_ENCODE_AMP)), 'helloworld', 'rip out tags using option flags');

$_SERVER['REQUEST_URI'] = '/test/a/b/c?hello=1';

$r = new Request();
T::is( $r->action(), '/test/a/b/c', 'action extracted from REQUEST_URI' );

$_POST = array('test1'=>'hello<script>world</script>');
$r = new Request( array('GET'=>new Input($_GET), 'POST'=>new Input($_POST) ) );

T::is( $r->POST->test1, 'helloscriptworld/script', 'Variable in post is filtered by default');
