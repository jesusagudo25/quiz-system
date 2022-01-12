<?php    

    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

    if ($contentType === "application/json") {

      $content = trim(file_get_contents("php://input"));
    
      $decoded = json_decode($content, true);

      if(is_array($decoded)) {
        echo json_encode('Ingresado correctamente!');
        $Archivo=fopen("registro.txt","a+") or die("No se puede abrir el archivo");
    
        fwrite($Archivo,$decoded['respUser']."\n");
    
        fclose($Archivo);
      } else {
         echo json_encode('ERROR!');
      }
     }
?>