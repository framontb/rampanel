<?php
declare(strict_types=1);
namespace Rampanel\User;

trait FtpUserTrait {
    public function getType(){
        return self::TYPE;
    }
}