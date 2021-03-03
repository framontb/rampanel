
<?php

define('BASE_DIR', __DIR__);
spl_autoload_register(
    function ($class) {
        $fn = str_replace('\\', '/', $class) . '.php';
        require(BASE_DIR . '/src/' . $fn);
    }
);

use \Rampanel\User\User;
use \Rampanel\User\Password;

$pass1 = new \Rampanel\User\User('jamones');
$pass1->printValidation();
$pass1->printErrors();

$pass2 = new User('Jamones123','@[.,*%&]@');
$pass2->printValidation();
$pass2->printErrors();

$pass3 = new User('Jamones123.,*&%!','@[.,*%&]@');
$pass3->printValidation();
$pass3->printErrors();