<?php
namespace Rampanel\User;

class FtpUser
{
    public const TYPE = 'FTP';

    /**
     * AbstractUser constructor.
     * @param string $username
     * @param Password $password
     */
    public function __construct(
        public string $username,
        private Password $password,
    ){}

    public function authenticatePassword(string $key):bool
    {
        return $this->password->authenticatePassword($key);
    }

    public function __toString()
    {
        return "My name is ".$this->username." but I don't tell you my pass...";
    }
}

