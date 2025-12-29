<?php
mb_internal_encoding('UTF-8');
function selectRandomWord() {
    $arrWord = ['яблоко', 'груша', 'персик'];
    if (empty($arrWord)) {
        return '';
    }
    $randomKey = array_rand($arrWord);
    return $arrWord[$randomKey];
}


function hideWord($word) {
    $asterisks = '';
    for ($i = 0; $i < mb_strlen($word); $i++) {
        $asterisks .= '_';
    }
    return $asterisks;
}


function input() {
    echo 'Введите букву: ';
    $handle = fopen ("php://stdin","r");
    $letter = fgets($handle);
    fclose($handle);
    return trim($letter); 
}


function checkGuess($word, $letter, &$guessedLetters, &$attemptsLeft) {
    if (in_array($letter, $guessedLetters)) {
        return; 
    }
    $guessedLetters[] = $letter;
    if (stripos($word, $letter) === false) {
        $attemptsLeft--; 
    }
}


function updateHiddenWord($word, $guessedLetters) {
    $str = '';
    for ($i = 0; $i < mb_strlen($word); $i++) {
        $currentChar = mb_substr($word, $i, 1);
        if (in_array($currentChar, $guessedLetters)) {
            $str .= $currentChar; 
        } else {
            $str .= '_'; 
        }
    }
    return $str;
}


function drawHangman($attemptsLeft) {
    $images = [
        "",
        "
_______________
|              |
|              
|             
|           
|
-----------------
",
        "
_______________
|              |
|              O
|             
|           
|
-----------------
",
        "
_______________
|              |
|              O
|              |
|           
|
-----------------
",
        "
_______________
|              |
|              O
|             /|
|           
|
-----------------
",
        "
_______________
|              |
|              O
|             /|\
|           
|
-----------------
",
        "
_______________
|              |
|              O
|             /|\
|             /
|
-----------------
",
        "
_______________
|              |
|              O
|             /|\
|             / \\
|
-----------------
"
    ];
    echo $images[count($images)-$attemptsLeft]."\n";
}


function isWordGuessed($word, $guessedLetters) {
    foreach (mb_str_split($word) as $char) {
        if (!in_array($char, $guessedLetters)) {
            return false; 
        }
    }
    return true; 
}



do {
   
    $word = selectRandomWord();                         
    $guessedLetters = [];                              
    $attemptsLeft = 6;                                 

   
    while ($attemptsLeft > 0 && !isWordGuessed($word, $guessedLetters)) {
       
        echo "Ваше слово: ".updateHiddenWord($word, $guessedLetters)."\n";
        echo "Оставшиеся попытки: ".$attemptsLeft."\n";

        
        drawHangman($attemptsLeft);

       
        $letter = input();

       
        checkGuess($word, $letter, $guessedLetters, $attemptsLeft);
    }

    
    if (isWordGuessed($word, $guessedLetters)) {
        echo "Поздравляю! Вы победили!\n";
    } else {
        echo "Игра закончилась. Вы проиграли.\n";
    }

    
    echo "Хотите сыграть ещё раз? (Y/N): ";
    $choice = trim(readline());

} while (strtolower($choice) === 'y');


echo "Спасибо за игру! До свидания.";

?>

