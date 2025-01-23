<?php

class PasswordValidator implements ValidationContract
{
    private $minLength;
    private $maxLength;

    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function validate($value): bool
    {
        // Vérifie que le mot de passe est une chaîne et respecte la longueur
        if (is_string($value) && strlen($value) >= $this->minLength && strlen($value) <= $this->maxLength) {
            // Hash du mot de passe avant de le retourner
            $hashedPassword = password_hash($value, PASSWORD_BCRYPT);
            return $hashedPassword;
        }
        
        return false;
    }
}