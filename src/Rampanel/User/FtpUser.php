<?php
declare(strict_types=1);
namespace Rampanel\User;

class FtpUser extends AbstractUser
{
    public const TYPE = 'FTP';

    use FtpUserTrait;
    /**
     * AbstractUser constructor.
     * @param string $username
     * @param Password $password
     * @param string $folder
     */
    public function __construct(
        public string $username,
        protected Password $password,
        public string $folder,
    ){}

    /**
     * Function to authenticate a candidate password
     * It's a wrapper of the authenticatePassword for Password Class.
     *
     * @param string $key
     * @return bool
     */
    public function authenticatePassword(string $key):bool
    {
        return $this->password->authenticatePassword($key);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return  parent::__toString().
                "My folder as ftp user is ".$this->folder."\n";
    }
}

