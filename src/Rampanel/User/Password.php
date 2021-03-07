<?php
namespace Rampanel\User;

class Password
{
    private const DEFAULT_PASS  = 'me_da_a_jana';
    private const MIN_LEN       = 7;

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
        // Some validations
        $this->validateUserRegex();
        $this->validateUpperCase();
        $this->validateLowerCase();
        $this->validateNumber();
        $this->validateLen();

        $this->isValid = $this->hasUpperCase && $this->hasLowerCase && $this->hasNumber
                        && $this->hasLen && $this->matchUserRegex ;
    }

    public function authenticatePassword(string $key):bool
    {
        if ($key == $this->password)
            return true;
        else
            return false;
    }

    private function validateUserRegex()
    {
        if (!is_null($this->user_regex_validator))
        {
            $this->matchUserRegex = preg_match($this->user_regex_validator, $this->password);
            if (!$this->matchUserRegex) $this->errors[] = 'PASS_WITHOUT_USER_REGEX';
            return $this->matchUserRegex;
        }
    }

    private function validateUpperCase()
    {
        $this->hasUpperCase = preg_match('@[A-Z]@', $this->password);
        if (!$this->hasUpperCase) $this->errors[] = 'PASS_WITHOUT_UPPERCASE';
        return $this->hasUpperCase;
    }

    private function validateLowerCase()
    {
        $this->hasLowerCase = preg_match('@[a-z]@', $this->password);
        if (!$this->hasLowerCase) $this->errors[] = 'PASS_WITHOUT_LOWERCASE';
        return $this->hasLowerCase;
    }

    private function validateNumber()
    {
        $this->hasNumber = preg_match('@[0-9]@', $this->password);
        if (!$this->hasNumber) $this->errors[] = 'PASS_WITHOUT_NUMBER';
        return $this->hasNumber ;
    }

    private function validateLen()
    {
        $this->hasLen = (strlen($this->password) > self::MIN_LEN);
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

