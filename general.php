<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php //Tener presente las funciones de arreglos...
        $cont = 0;
        $contEstudPuntos = [0,0,0,0,0,0,0,0,0,0,0];
        $tiempos = [];
        $resp= [0,2,1,0,2,0,2,1,1,0];

        $aciertos = [0,0,0,0,0,0,0,0,0,0,0];
        $fallas = [0,0,0,0,0,0,0,0,0,0,0];
        
        if ( !file_exists("registro.txt") ) {
            header("Location: index.php");
        }

        $archivo=fopen("registro.txt","r") or die("No se puede abrir el archivo");

        While (!feof($archivo)){
            $linea = fgets($archivo, 4096); 
            if(strcmp($linea,"") != 0){
                $componente = explode("/",$linea);
                
                $respuestasUser = explode("-",$componente[1]);

                foreach($respuestasUser as $posicion => $v){
                    if(strcmp($v,"") != 0){
                        if($v == $resp[$posicion]){
                            $aciertos[$posicion]++;

                        }
                        else{
                            $fallas[$posicion]++;
                        }
                    }
                }
                
                $cont++;
                $contEstudPuntos[$componente[2]]++;

                list($hora,$minuto,$segundo) = explode(":",$componente[3]);
                
                $tiempos[] = $hora + $minuto + $segundo;
            }
        }
        
        fclose($archivo);
        $index = count($contEstudPuntos);
        $j = 1;
    ?>

    <p>Cantidad de practicas completadas: <?= $cont?></p>
    <p>Tiempo maximo en resolver: <?= max($tiempos) ?> </p>
    <p>Tiempo minimo en resolver: <?= min($tiempos) ?> </p>
    <p>Cantidad de estudiantes por puntajes correctos: </p>
    <table border="2">
        <tr>
            <th>Puntos obtenidos</th> 
            <th>Cant. de estudiantes</th>
        </tr>

        <?php while($index) { ?>
            <tr>
                <td><?= --$index?></td>
                <td><?= $contEstudPuntos[$index]?></td>
            </tr>
        <?php } ?>

        
    </table>

    <p>Estadística de aciertos y fallas: </p>
    <table border="2">
        <tr>
            <th>Pregunta</th> 
            <th>Cantidad de aciertos</th>
            <th>Cantidad de fallas</th>
        </tr>

        <?php while($j<=10) { ?>
            <tr>
                <td> <?= $j++?> </td>
                <td> <?= $aciertos[$j-2]?> </td>
                <td> <?= $fallas[$j-2]?> </td>
            </tr>
        <?php } ?>

        
    </table>

    <button id="generar">Generar archivo</button>

        
    <script>
        let botonGenerar = document.querySelector("#generar");
        botonGenerar.addEvenetListener("click", e =>{
            <?php
                $index = count($contEstudPuntos);
                $j = 1;

                $Archivo=fopen("reporte.txt","w+") or die("No se puede abrir el archivo");

                fwrite($Archivo,'Cantidad de practicas completadas: '. $cont."\n".
                'Tiempo maximo en resolver: '.max($tiempos)."\n".
                'Tiempo minimo en resolver: ' .min($tiempos)."\n".
                'Cantidad de estudiantes por puntajes correctos:'."\n".
                'Puntos obtenidos' ."\t". 'Cant. de estudiantes'."\n");

                while($index) {
                    fwrite($Archivo,--$index."\t\t\t\t". $contEstudPuntos[$index]."\n");
                }

                fwrite($Archivo,'Estadística de aciertos y fallas:'."\n".
                'Pregunta' ."\t". 'Cantidad de aciertos'."\t". 'Cantidad de fallas'."\n");    

                while($j<=10) {
                    fwrite($Archivo,$j++."\t\t\t". $aciertos[$j-2]."\t\t\t". $fallas[$j-2]."\n");
                }        
                fclose($Archivo);
            
            ?>
        });
    </script>
</body>
</html>