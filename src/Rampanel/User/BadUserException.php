<?php
declare(strict_types=1);
namespace Rampanel\User;
use \Exception;

class BadUserException extends Exception {
    public function __construct(CheckUserIntegrity $user, ?int $en)
    {
        $msg = (string)$user;
        parent::__construct($msg, $en);
    }
}