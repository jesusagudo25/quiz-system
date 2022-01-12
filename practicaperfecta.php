<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Lista de Estudiantes con práctica perfecta</h2>
    <ol>
        <?php
            if ( !file_exists("registro.txt") ) {
                header("Location: index.php");
            }

            $sw = 0;
            $archivo=fopen("registro.txt","r") or die("No se puede abrir el archivo");

            While (!feof($archivo)){
                $linea = fgets($archivo, 4096); 
                if(strcmp($linea,"") != 0){
                    $componente = explode("/",$linea);
                    if($componente[2] == 10){
                        echo "<li>$componente[0] $componente[2]</li>";
                        $sw=1;
                    }
                }
            }
            
            if($sw==0){
                echo '<li>No existen estudiantes con puntaje perfecto</li>';
            }

            fclose($archivo);
        ?>
    </ol>
</body>
</html>