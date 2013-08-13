<?php
namespace Wukka\Shortcircuit\Iface;

interface View {
    public function render( $name );
    public function fetch( $name );
    public function call($name);
    public function request();
    public function server();
}
