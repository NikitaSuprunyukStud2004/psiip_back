<html> 
 <head> 
 <title>Чтение из текстовых файлов</title> 
 </head> 
 <body> 
 <?php 
 $f = fopen("../Exercise_1/test.txt", "r"); 
 // Читать строку их текстового файла и записать содержимое клиенту 
 echo fgets($f);  
 
 // Читать построчно до конца файла 
 while(!feof($f)) {  
     echo fgets($f) . "<br />"; 
 } 
 
 fclose($f); 
 ?> 
 </body> 
 </html>