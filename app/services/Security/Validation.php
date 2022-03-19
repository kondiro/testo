<?php

namespace App\services\Security;

class Validation
{
    public const PHONE_NUMBER_REGEX = "/^([0-9\s\-\+\(\)]*)$/";
    public const IMAGE_VALIDATOR = "image|mimes:jpeg,png,jpg|max:2048";
}
