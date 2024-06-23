<?php

// function per generare password
function generatePassword($length, $allowRepeats, $includeLetters, $includeNumbers, $includeSymbols){
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
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- css bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-primary">
    <!-- titoli di password -->
    <header class="text-center">
        <h1 class=" mt-5"><strong class=" text-primary-emphasis">Strong Password Generator</strong></h1>
        <h2><strong class="text-white">Genera una password sicura</strong></h2>
    </header>
    <main>
        <div class="bg-primary-subtle container rounded">
            <!-- genera password -->
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
        </div>
        <!-- parametri per la passsword -->
        <div class="w-100 bg-white container rounded py-4 px-3">
            <form method="get" action="">
                <div class="py-4 d-flex justify-content-between">
                    <label for="password_length">Lunguezza Password:</label>
                    <input type="text" name="password_length" class="form-control w-25 mx-5" id="password_length">
                </div>
                <div class="py-4 d-flex justify-content-between">
                    <label>Consenti ripetizioni di uno o più caratteri:</label>
                    <div class="px-5 mx-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="repeats" id="flexRadioDefault1" value="yes">
                            <label class="form-check-label" for="flexRadioDefault1">
                                SI
                            </label>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="radio" name="repeats" id="flexRadioDefault2" value="no">
                            <label class="form-check-label" for="flexRadioDefault2">
                                No
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="letters" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Lettere
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="numbers" value="1" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Numeri
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symbols" value="1" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Simboli
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Invio</button>
                <button type="reset" class="btn btn-secondary">Annulla</button>
            </form>
        </div>
    </main>

</body>

</html>