<html> 
 <head> 
 <title>Файловая система</title> 
 </head> 
 <body> 
 
 <?php 
    
 // Найти и записать свойства 
 $file_name = 'test.txt';
 echo "<h1>file: $file_name</h1>"; 
 echo "<p>В последний раз редактировался: " . date("r", filemtime($file_name));  
 echo "<p>В последний раз был открыт: " . date("r", fileatime($file_name));  
 echo "<p>Размер: " . filesize($file_name) . " байт"; 
  
 ?> 
 
 </body> 
 </html> 