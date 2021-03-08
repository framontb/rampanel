<?php
declare(strict_types=1);

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
    $ftpUser = new FtpUser('Jumersindo', $pass1, '/home/hosting/ftp');

    // try to authenticate some candidate passwords
    authenticate($ftpUser, 'badPass');
    authenticate($ftpUser, 'Jamones3');

    // Interface methods from AbstractUser
    if ($ftpUser->validateUsername());
        echo "Username validates\n";

    // Interface methods from AbstractUser
    if ($ftpUser->validatePassword());
    echo "Password validates\n";
}

/**
 * Authenticate a user pass and echo messages with result
 * @param $user
 * @param $candidatePass
 */
function authenticate($user, $candidatePass)
{
    if ($user->authenticatePassword($candidatePass))
    {
        echo "------ authenticate -------\n";
        echo "Access Granted.\n";
        echo $user;
    }
    else
    {
        echo "------ authenticate -------\n";
        echo "Password doesn't authenticate.\n";
    }

}
