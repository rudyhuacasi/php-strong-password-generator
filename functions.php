<?php
// function per generare password
function generatePassword($length, $allowRepeats, $includeLetters, $includeNumbers, $includeSymbols)
{
    // variabili per le lettere , numeri e simboli
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?';

    // condizionale per unire lettere , numeri e simboli
    $characters = '';
    if ($includeLetters) $characters .= $letters;
    if ($includeNumbers) $characters .= $numbers;
    if ($includeSymbols) $characters .= $symbols;

    // una condizionale per scegliere un carattere
    if (strlen($characters) == 0) {
        return 'Seleziona almeno un tipo di carattere.';
    }

    // genera password randomico con delle lettere , numeri e simboli
    $password = '';
    $charactersLength = strlen($characters);
    for ($i = 0; $i < $length; $i++) {
        $randomChar = $characters[random_int(0, $charactersLength - 1)];
        if (!$allowRepeats && strpos($password, $randomChar) !== false) {
            $i--;
            continue;
        }
        $password .= $randomChar;
    }
    return $password;
}

?>