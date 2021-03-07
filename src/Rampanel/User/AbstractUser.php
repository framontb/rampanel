<?php
namespace Rampanel\User;

abstract class AbstractUser
{
    public const TYPE = 'ABSTRACT';

    /**
     * AbstractUser constructor.
     * @param string $username
     * @param Password $password
     */
    public function __construct(
        public string $username,
        private Password $password,
    ){}

    abstract public function authenticatePassword(string $key):bool;
}

