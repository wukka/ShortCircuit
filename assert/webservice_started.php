<?php
use Wukka\Test as T;

if( ! @fsockopen('127.0.0.1', 11298) ){
    T::plan('skip_all', 'http://127.0.0.1:11298/ not started. run ./tests/app.start.php.sh');
}