#!/usr/bin/env php
<?php
use Wukka\Test as T;

include __DIR__ . '/../autoload.php';
include __DIR__ . '/../assert/curl_installed.php';
include __DIR__ . '/../assert/webservice_started.php';

$baseurl = 'http://127.0.0.1:11298/shortcircuit.php';

T::plan(9);

$ch = curl_init("$baseurl/test/");
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = trim(curl_exec($ch));
$info = curl_getinfo($ch);
curl_close($ch);

T::is( $info['http_code'], 200, 'page request returned a 200 ok response');
T::is($res, 'hello 123', 'got back the content I expected');

$ch = curl_init("$baseurl/idtest/123/");
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = trim( curl_exec($ch) );
$info = curl_getinfo($ch);
curl_close($ch);
T::is($res, '<p>id: 123</p>', 'the id in the url was mapped into the request');

$ch = curl_init("$baseurl/linktest/?");
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = trim( curl_exec($ch) );
$info = curl_getinfo($ch);
T::is($res, '<a href="/shortcircuit.php/lt///">linktest</a>', 'Link parameters mapped into a url with correct base url');

$ch = curl_init("$baseurl/lt/3/2/1/");
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = trim( curl_exec($ch) );
$info = curl_getinfo($ch);

T::is($res, '<a href="/shortcircuit.php/lt/3/2/1">linktest</a>', 'params in the url are mapped into a link with correct base url');

$ch = curl_init("$baseurl");
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = trim(curl_exec($ch));
$info = curl_getinfo($ch);
curl_close($ch);

T::is( $info['http_code'], 200, 'tested the entry point with no url args or params');
T::like($res, '/site index/i', 'got back the content I expected');

$ch = curl_init("$baseurl/idtest/john%20wayne/");
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = trim( curl_exec($ch) );
$info = curl_getinfo($ch);
curl_close($ch);
T::is($res, '<p>id: john wayne</p>', 'the name with the space in the url was mapped into the request');


use Wukka\ShortCircuit\Resolver;
$r = new Resolver;
$r->setAppDir( __DIR__ . '/app/' );
$expected = array('foo'=>'bar', 'bazz'=>array('1','2','3', 'quux'=>array('a','b','c')));

$link = $r->link('printrequest', $expected );

$ch = curl_init($baseurl . $link);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
$res = json_decode( $raw = trim( curl_exec($ch) ), TRUE);
$info = curl_getinfo($ch);
curl_close($ch);

T::cmp_ok( $res, '===', $expected, 'deeply nested complex data structure passed in url');

