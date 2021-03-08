<?php
namespace Rampanel\User;

abstract class AbstractUser implements CheckUserIntegrity
{
    public const TYPE = 'ABSTRACT';
    public const USERNAME_MIN_LEN = 5;

    /**
     * AbstractUser constructor.
     * @param string $username
     * @param Password $password
     */
    public function __construct(
        public string $username,
        protected Password $password,
    ){}

    // ABSTRACT METHOD
    abstract public function authenticatePassword(string $key):bool;

    // INTERFACE CheckUserIntegrity implementation
    public function validatePassword():bool
    {
        return $this->password->validatePassword();
    }

    // INTERFACE CheckUserIntegrity implementation
    public function validateUsername():bool
    {
        return strlen($this->username) > self::USERNAME_MIN_LEN;
    }

    // MAGIC FUNCTION
    public function __toString()
    {
        return "My name is ".$this->username." but I don't tell you my pass.\n";
    }
}

