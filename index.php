
<?php

define('BASE_DIR', __DIR__);
spl_autoload_register(
    function ($class) {
        $fn = str_replace('\\', '/', $class) . '.php';
        require(BASE_DIR . '/src/' . $fn);
    }
);

use \Rampanel\User\FtpUser;
use \Rampanel\User\Password;

// Instatantiate a Password object
$pass1 = new Password('Jamones3');
$pass1->printValidation();
$pass1->printErrors();

# If valid password create user
if ($pass1->isValid)
{
    // Instantiate FtpUser object
    $ftpUser = new FtpUser('Jumersindo', $pass1);

    // try to authenticate some candidate passwords
    authenticate($ftpUser, 'badPass');
    authenticate($ftpUser, 'Jamones3');
}

/**
 * Authenticate a user pass
 * @param $user
 * @param $candidatePass
 */
function authenticate($user, $candidatePass)
{
    if ($user->authenticatePassword($candidatePass))
    {
        echo "------ authenticate -------\n";
        echo "Good Pass\n";
        echo $user;
    }
    else
    {
        echo "------ authenticate -------\n";
        echo "Bad Pass\n";
    }

}
