<?php

// this php file can be found at: 

// array_lenght: receives an array as an argument and returns its lenght 

function array_Lenght($array){
    $tam = 0;
    foreach ($array as $i){
        $tam+=1;
    }
    return $tam;
}

// array_popIndex: receives an array and an index as an argument and returns an array without the index received. Similar to pop in python

function array_popIndex($array, $index){

    $TAM = array_Lenght($array);
    $newArray = [];

    for($i=0;$i<$TAM;$i++){
        if($i!=$index){
            $newArray[] = $array[$i];
        }
    }   
    return $newArray;
}
