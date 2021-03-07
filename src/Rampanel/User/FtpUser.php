<?php
namespace Rampanel\User;

class FtpUser extends AbstractUser
{
    public const TYPE = 'FTP';

    /**
     * AbstractUser constructor.
     * @param string $username
     * @param Password $password
     * @param string $folder
     */
    public function __construct(
        public string $username,
        private Password $password,
        public string $folder,
    ){}

    public function authenticatePassword(string $key):bool
    {
        return $this->password->authenticatePassword($key);
    }

    public function __toString()
    {
        return  parent::__toString().
                "My folder as ftp user is ".$this->folder."\n";
    }
}

