<?php

class PasswordValidator implements ValidationContract
{
    private $maxLength;

    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function validate($value): bool
    {
        // Vérifie que le mot de passe est une chaîne et respecte la longueur
        return is_string($value) && strlen($value) <= $this->maxLength;
    }
}