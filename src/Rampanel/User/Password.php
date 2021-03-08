<?php
declare(strict_types=1);
namespace Rampanel\User;

class Password
{
    private const DEFAULT_PASS  = 'me_da_a_jana';
    private const PASS_MIN_LEN       = 7;

    private bool $matchUserRegex  = true;
    private bool $hasUpperCase  = false;
    private bool $hasLowerCase  = false;
    private bool $hasNumber     = false;
    private bool $hasLen        = false;

    public  bool $isValid       = false;
    public array $errors        = array();

    public function __construct(
        protected $password,
        protected $user_regex_validator=null,
    )
    {
        $this->validatePassword();
    }

    public function authenticatePassword(string $key):bool
    {
        if ($key == $this->password)
            return true;
        else
            return false;
    }

    public function validatePassword():bool
    {
        // Some validations
        $this->validateUserRegex();
        $this->validateUpperCase();
        $this->validateLowerCase();
        $this->validateNumber();
        $this->validateLen();

        $this->isValid = $this->hasUpperCase && $this->hasLowerCase && $this->hasNumber
            && $this->hasLen && $this->matchUserRegex ;

        return $this->isValid;
    }

    private function validateUserRegex():bool
    {
        if (!is_null($this->user_regex_validator))
        {
            $this->matchUserRegex = preg_match($this->user_regex_validator, $this->password);
            if (!$this->matchUserRegex) $this->errors[] = 'PASS_WITHOUT_USER_REGEX';
        }
        return $this->matchUserRegex;
    }

    private function validateUpperCase():bool
    {
        $this->hasUpperCase = (bool)preg_match('@[A-Z]@', $this->password);
        if (!$this->hasUpperCase) $this->errors[] = 'PASS_WITHOUT_UPPERCASE';
        return $this->hasUpperCase;
    }

    private function validateLowerCase():bool
    {
        $this->hasLowerCase = (bool)preg_match('@[a-z]@', $this->password);
        if (!$this->hasLowerCase) $this->errors[] = 'PASS_WITHOUT_LOWERCASE';
        return $this->hasLowerCase;
    }

    private function validateNumber():bool
    {
        $this->hasNumber = (bool)preg_match('@[0-9]@', $this->password);
        if (!$this->hasNumber) $this->errors[] = 'PASS_WITHOUT_NUMBER';
        return $this->hasNumber ;
    }

    private function validateLen():bool
    {
        $this->hasLen = (strlen($this->password) > self::PASS_MIN_LEN);
        if (!$this->hasLen) $this->errors[] = 'PASS_WITHOUT_LEN';
        return $this->hasLen ;
    }

    public function printValidation()
    {
        print "---------------------\n";
        if ($this->isValid) print "The Password is valid\n";
        else print "Invalid Password\n";
    }

    public function printErrors()
    {
        if (! $this->isValid)
        {
            foreach ($this->errors as $error)
            {
                print $error."\n";
            }
        }
    }
}

