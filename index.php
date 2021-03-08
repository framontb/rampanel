<?php
declare(strict_types=1);

define('BASE_DIR', __DIR__);
spl_autoload_register(
    function ($class) {
        $fn = str_replace('\\', '/', $class) . '.php';
        require(BASE_DIR . '/src/' . $fn);
    }
);

use \Rampanel\User\Password;    // Added to Abstract class as property
use \Rampanel\User\FtpUser;     // Implementation of abstract class AbstractUser
use \Rampanel\User\UserList;    // Collection of users in array for Type hinting
use \Rampanel\User\BadUserException; // Custom Exception

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

    // Lab: Interface
    // Interface methods from AbstractUser
    if ($ftpUser->validateUsername());
        echo "Username validates\n";

    // Interface methods from AbstractUser
    if ($ftpUser->validatePassword());
    echo "Password validates\n";

    // Lab: Type hinting the interface
    $userList = new UserList($ftpUser);

    // Lab: Exceptions
    try {
        // throw new Exception ("Me Da A Jana");
        throw new BadUserException($ftpUser, 7);
    } catch (BadUserException $e) {
        echo "BEGIN BadUserException MSG ---> \n";
        echo $e->getMessage();
        echo "<--- END BadUserException MSG\n";
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        echo "FINALLY\n";
    }

    // Lab: Trait
    echo "Type of user: ";
    echo $ftpUser->getType();
    echo "\n";
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
