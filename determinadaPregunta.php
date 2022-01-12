<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h2>Lista de estudiantes que han fallado una determinada pregunta</h2>
    <ol>
    <?php
        if(!isset($_POST['pregunta'])){
            header("Location: index.php");
        }

        $sw=0;

        $preg = ['¿Primer sistema operativo con interfaz grafica?',
                          '¿Año que se fundo GOOGLE?',
                          '¿Cuando se fundo HUAWEI?',
                          '¿Qué es un SSD?',
                          '¿Qué es el procesador?',
                          '¿Cuándo nacio Steve Jobs?',
                          '¿Provincia de Panamá rodeada de 2 mares?',
                          '¿Cuándo nacio Steve Wozniak?',
                          '¿Red Social mas popular?',
                          '¿Capital del país de Panamá?'
        ];
        
        $opc= [0,2,1,0,2,0,2,1,1,0];

        $archivo=fopen("registro.txt","r") or die("No se puede abrir el archivo");

        while (!feof($archivo)){
            $linea = fgets($archivo, 4096); 
            if(strcmp($linea,"") != 0){
                
                $componente = explode("/",$linea);
                
                $respuestasUser = explode("-",$componente[1]);

                if($respuestasUser[$_POST['pregunta']] != $opc[$_POST['pregunta']]){
                    echo "<li>$componente[0]</li>";
                    $sw=1;
                }
            }
        }
        if($sw==0){
            echo '<li>No hay estudiantes que hayan fallado esta pregunta</li>';
        }

    ?>
    </ol>
</body>
</html>