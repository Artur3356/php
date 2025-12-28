<?php

function selectRandomWord() {
    $arrWord = ['apple', 'pear', 'peach'];
    if (empty($arrWord)) {
        return '';
    }
    $randomKey = array_rand($arrWord);
    return $arrWord[$randomKey];
}


function hideWord($word) {
    $asterisks = '';
    for ($i = 0; $i < strlen($word); $i++) {
        $asterisks .= '_';
    }
    return $asterisks;
}


function input() {
    return trim(readline('Введите букву: '));
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
    for ($i = 0; $i < strlen($word); $i++) {
        if (in_array($word[$i], $guessedLetters)) {
            $str .= $word[$i]; 
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
    foreach (str_split($word) as $char) {
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