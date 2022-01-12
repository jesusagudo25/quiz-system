<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>Lista de los estudiantes con los 10 mejores tiempos</h2>
    <ol>
    <?php
        if ( !file_exists("registro.txt") ) {
            header("Location: index.php");
        }

        $i =0;

        $personas= array();
        
        $archivo=fopen("registro.txt","r") or die("No se puede abrir el archivo");

        While (!feof($archivo)){
            $linea = fgets($archivo, 4096); 
            if(strcmp($linea,"") != 0){
                $componente = explode("/",$linea);

                list($hora,$minuto,$segundo) = explode(":",$componente[3]);
                
                $personas[$i]['nombre'] = $componente[0];
                $personas[$i++]['tiempo'] = $hora + $minuto + $segundo;
            }
        }
        
        usort($personas, function($a, $b) {
            return $a['tiempo'] <=> $b['tiempo'];
        });

        if($i>=10){
            for($j=0; $j<10;$j++){
                echo '<li>'.$personas[$j]['nombre'].' '.$personas[$j]['tiempo'].'</li>';
            }
        }
        else{
            for($j=0; $j<$i;$j++){
                echo '<li>'.$personas[$j]['nombre'].' '.$personas[$j]['tiempo'].'</li>';
            }
            echo '<li>***El archivo no cuenta con mas registros***</li>';            
        }

        fclose($archivo);
    ?>
    </ol>
    
</body>
</html>