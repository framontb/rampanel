<?php
declare(strict_types=1);
namespace Rampanel\User;

interface CheckUserIntegrity {
    public function validateUsername():bool;
    public function validatePassword():bool;
}