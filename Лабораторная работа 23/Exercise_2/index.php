<html> 
 <head> 
 <title>FileSystemObject</title> 
 </head> 
 <body> 
 <?php 
    
 // Открыть папку 
 $folder = opendir("../../Карточка 1/client/"); 
 // Цикл по всем файлам папки 
 while (($entry = readdir($folder)) != "") { 
    echo $entry . "<br />"; 
 } 
 // Закрыть папку 
 $folder = closedir($folder); 
 ?> 
 </body> 
 </html>