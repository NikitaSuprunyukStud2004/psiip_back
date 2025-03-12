<html> 
    <head> 
        <title>Запись в текстовый файл</title> 
    </head> 
    <body> 
        <?php
// Открыть текстовый файл 
        $f = fopen("textfile.txt", "w");
// Записать строку текста 
        fwrite($f, "PHP is fun!");
// Закрыть текстовый файл 
        fclose($f);
// Открыть файл для чтения и прочитать строку 
        $f = fopen("textfile.txt", "r");
        echo fgets($f);
        fclose($f);

// Открыть текстовый файл 
        $f = fopen("textfile.txt", "w");
// Записать текст 
        fwrite($f, $_POST["textblock"]);
// Закрыть текстовый файл 
        fclose($f);
// Открыть файл для чтения и прочитать строку 
        $f = fopen("textfile.txt", "r");
// Читать текст 
        echo fgets($f);
        fclose($f);
        $f
        ?> 
    </body> 
</html> 