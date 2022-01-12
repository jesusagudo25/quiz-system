<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulo estudiante</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="./assets/js/app.js" defer></script>
</head>
<body>
    <div>
        <script>let nameUser =  prompt("Bienvenido, Escribe tu nombre");</script>

        <header class="header">
            <h2>Preguntas aleatorias</h2>
            <p id="nombre">Modulo estudiante: </p>
        </header>
        <main>
            <section class="preguntas">
                <h3 id="pregunta">¿Primer sistema operativo con interfaz grafica?</h3>
                <p>Seleccione su respuesta:</p>
                <form action="#" >
                    <input type="radio" id = "0" name = "seleccion" /> <label id = "10">Xenox</label>
                    <input type="radio" id = "1" name = "seleccion" /> <label id = "11">Windows</label>
                    <input type="radio" id = "2" name = "seleccion" /> <label id = "12">Linux</label> 
                </form>
                <p id="feedback"></p>
            </section>
        </main>
    </div>
</body>
</html>