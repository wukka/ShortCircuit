<?php
use Wukka\Test as T;

if( ! @fsockopen('127.0.0.1', 11299) ){
    T::plan('skip_all', 'http://127.0.0.1:11299/ not started. run ./tests/app.start.php.sh');
}