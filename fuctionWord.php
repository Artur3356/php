<?php
mb_internal_encoding('UTF-8');
function selectRandomWord(){
$randomWord = ['груша', 'яблоко', 'персик', 'клубника'];
if(empty($randomWord)){
return '';
}
$randomKey = array_rand($randomWord);
return $randomWord[$randomKey];
}

function input(){
echo 'Введите букву: ';
%handle = fopen("php://stdin", "r");
$letter = fgets($handle);
fclose($handle);
return trim($letter);
}

function checkGuess($word, $letter, &$arrLetter, &$count){
if(in_array($letter, $arrLetter)){
return;
}
$arrLetter[]=$letter;
if(mb_stripos($word, $letter)===false){
$count--;
}
}
function updateWord($word, $arrLetter){
$strWord = '';
for($i = 0; $i < mb_strlen($word); $i++){
$letterNew = mb_substr($word, $i, 1);
if(in_array($letterNew, $arrLetter)){
$strWord .= $letterNew;
}else{
$strWord .='_';
}
}
return $strWord;
}
funtion isWord($word, $arrLetter){
for($i=0; $i < mb_strlen($word); $i++){
$char = mb_substr($word, $i, 1);
if(!in_array($char, $arrLetter){
return false;
}                 
}                 
return true;
}
