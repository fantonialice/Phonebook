
<?php
//Phone Book in php

require('arrayfunctions.php'); // File that contains some of the functions used in this Main

$names = [];
$phoneNumbers = [];

function openPhoneBook($names, $phoneNumbers){
    unset($names);
    unset($phoneNumbers);
    $file = 'phonebook.txt';
    
    if(!file_exists($file)){
    touch($file);
    }
    $openFile = fopen($file, 'a+');
    $fileContent = file_get_contents($file);

    $keywordsLine = preg_split("/\n/", $fileContent);
    
    for($i=0;$i<array_Lenght($keywordsLine);$i++){
        if($keywordsLine!=NULL){
           $keywords[$i] = preg_split("/;/", $keywordsLine[$i]); 
        }             
    }

    for($i=0;$i<array_Lenght($keywords);$i++){
        $names[] = $keywords[$i][0]; 
        $phoneNumbers[] = $keywords[$i][1]; 
    }

    fclose($openFile);
    
    $return = [$names, $phoneNumbers];
    return $return;
}

function createContacts($names, $phoneNumbers){
    echo(PHP_EOL);
    $name = readline("Name: ");
    $names[] = $name;
    $phoneNumber = readline("Phone number: ");
    $phoneNumbers[] = $phoneNumber;
    
    $return =  [$names, $phoneNumbers];
    return $return;
}

function listContacts($names, $phoneNumbers){  
    echo(PHP_EOL);
    var_dump($names);
    echo(PHP_EOL);
    for($i=0;$i<array_Lenght($names);$i++){
        $count=$i+1;
        echo("Contact " . $count . PHP_EOL);
        echo("Name: " . $names[$i] . PHP_EOL);
        echo("Phone number: " . $phoneNumbers[$i] . PHP_EOL);
        echo("----------------------------------\n");
        echo(PHP_EOL);
        
    }
}

function savePhoneBook($names, $phoneNumbers){
    $file = 'phonebook.txt';
    $openFile = fopen($file, 'w+');
    if((is_resource($openFile)) && ($names[0]!= NULL)){
        fwrite($openFile, "$names[0];$phoneNumbers[0]");
    }
    for($i=1;$i<array_Lenght($names);$i++){
        if ($names[$i]!=NULL){
            fwrite($openFile, "\n$names[$i];$phoneNumbers[$i]");
        }
    }
    
       
    if (is_resource($openFile)) {
        fclose($openFile);
    }
    
    echo("Arquivos salvos!\n");
    
}
    
function removeContacts($names, $phoneNumbers){
    echo(PHP_EOL);
    for($i=0;$i<array_Lenght($names);$i++){
        $count=$i+1;
        echo("Contact " . $count . ": " . $names[$i]);
        echo("\n-----------------\n");
        echo(PHP_EOL);
    }
    $id = ((int)readline("Contact id: "));
    $id = $id-1;

    $names = array_popIndex($names, $id);
    $phoneNumbers = array_popIndex($phoneNumbers, $id);

    $return =  [$names, $phoneNumbers];
    return $return;
}

function updateContact($names, $phoneNumbers){
    echo(PHP_EOL);
    for($i=0;$i<array_Lenght($names);$i++){
        $count=$i+1;
        echo("Contact id: " . $count . PHP_EOL);
        echo("Name: " . $names[$i] . PHP_EOL);
        echo("Phone numer: $phoneNumbers[$i]" . PHP_EOL);
        
        echo("\n-----------------\n");
        echo(PHP_EOL);
    }
    $id = ((int)readline("Contact id: "));
    $id = $id-1;

    $names[$id] = readline("New name: ");
    $phoneNumbers[$id] = readline("New phone number: ");
    
    $return =  [$names, $phoneNumbers];
    return $return;
}
// main

$op = -1;
while ($op != 0){
    echo(PHP_EOL);

    $return = openPhoneBook($names, $phoneNumbers);
    $names = $return[0];
    $phoneNumbers = $return[1];
    
    //echo("Choose an option: \n");
    echo(" MENU   ". PHP_EOL);
    echo(" 1 - Create Contact \n");
    echo(" 2 - List Contacts \n");
    echo(" 3 - Update Contact \n");
    echo(" 4 - Remove Contact \n");
    echo(" 0 - Exit \n");
    $op = (int)readline("Option: "); 
    
    switch($op){
        case 0:
            break;
        case 1:
            $return = createContacts($names, $phoneNumbers);
            $names = $return[0];
            $phoneNumbers = $return[1];
            savePhoneBook($names, $phoneNumbers);
            break;
        case 2:
            listContacts($names, $phoneNumbers);
            break;
        case 3:
            $return = updateContact($names, $phoneNumbers);
            $names = $return[0];
            $phoneNumbers = $return[1];
            savePhoneBook($names, $phoneNumbers);
            break;
        case 4:
            $return = removeContacts($names, $phoneNumbers);
            $names = $return[0];
            $phoneNumbers = $return[1];
            savePhoneBook($names, $phoneNumbers);
            break;
    }
    
}
