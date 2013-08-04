<?php
namespace Wukka\Shortcircuit\Iface;

interface Request {
    public function action();
    public function uri();
    public function base();
    public function get( $key );
}
