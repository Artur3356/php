<?php
require_once __DIR__ 'functionWord.php';
require_once __DIR__ 'pickcha.php';

echo '===Игра виселеца===';
echo 'Отгадайте слово.У вас 6 попыток. Слово - это слово название фрукта';


do {
   
    $word = selectRandomWord();                         
    $arrLetter = [];                              
    $count = 6;                                 

   
    while ($count > 0 && !isWord($word, $arrLetters)) {
       
        echo "Ваше слово: ".updateWord($word, $arrLetters)."\n";
        echo "Оставшиеся попытки: ".$count."\n";

        
        drawHaunger($count);

       
        $letter = input();

       
        checkGuess($word, $letter, $arrLetters, $count);
    }

    
    if (isWord($word, $arrLetters)) {
        echo "Поздравляю! Вы победили!\n";
    } else {
        echo "Игра закончилась. Вы проиграли.\n";
    }

    
    echo "Хотите сыграть ещё раз? (Y/N): ";
    $play = trim(readline());

} while (mb_strtolower($play) === 'y');


echo "Спасибо за игру! До свидания.";

?>




