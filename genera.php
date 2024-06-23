<?php
    if (isset($_GET['password_length'])) {
        $length = intval($_GET['password_length']);
        $allowRepeats = isset($_GET['repeats']) && $_GET['repeats'] == 'yes';
        $includeLetters = isset($_GET['letters']);
        $includeNumbers = isset($_GET['numbers']);
        $includeSymbols = isset($_GET['symbols']);
    // genera una condizionale per una password generata e una lunghezza che non è valida
        if ($length > 0) {
            $password = generatePassword($length, $allowRepeats, $includeLetters, $includeNumbers, $includeSymbols);
            echo "<p class='py-3 px-2 w-100'>Password generata: $password</p>";
        } else {
            echo "<p class='py-3 px-2 w-100'>Inserisci una lunghezza valida.</p>";
        }
    } else {
        echo "<p class='py-3 px-2 w-100'>Nessun parametro valido inserito</p>";
    }
?>
