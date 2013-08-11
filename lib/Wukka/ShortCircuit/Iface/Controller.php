<?php
namespace Wukka\Shortcircuit\Iface;

interface Controller  {
    public function execute($name, $strict = TRUE );
    public function request();
    public function server();
}
