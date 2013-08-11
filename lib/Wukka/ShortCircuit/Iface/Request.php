<?php
namespace Wukka\Shortcircuit\Iface;

interface Request extends \Wukka\Store\Iface {
    public function action();
    public function uri();
    public function base();
}
