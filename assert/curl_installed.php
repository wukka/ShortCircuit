<?php
use Wukka\Test as T;

if( ! function_exists('curl_init') ){
    T::plan('skip_all', 'php curl library not installed');
}
