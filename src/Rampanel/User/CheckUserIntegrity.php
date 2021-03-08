<?php
namespace Rampanel\User;

interface CheckUserIntegrity {
    public function validateUsername():bool;
    public function validatePassword():bool;
}