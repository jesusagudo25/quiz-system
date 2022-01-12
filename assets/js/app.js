let inicio = new Date();

//Convertir milisegundos a tiempo -- Modulo aparte
function msToTime(duracion) {
    let milliseconds = parseInt((duracion % 1000) / 100),
    seconds = Math.floor((duracion / 1000) % 60),
    minutes = Math.floor((duracion / (1000 * 60)) % 60),
    hours = Math.floor((duracion / (1000 * 60 * 60)) % 24);

    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    return hours + ":" + minutes + ":" + seconds + "." + milliseconds;
}

//---------------

let preg=['¿Primer sistema operativo con interfaz grafica?',
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

let resp=['Xenox-Windows-Linux',
            '1998-1999-2015',
            '1987-1992-1883',
            'Unidad de almacenamiento-Avion-Tarjeta grafica',
            'El cerebro de una computadora-Un carro-Disco duro',
            '1955-1732-1231',
            'Veraguas-Colon-Los Santos',
            '1950-1932-1999',
            'Facebook-Twitter-Whatsapp',
            'Panamá-Colon-Darien'
];

let opc= [0,2,1,0,2,0,2,1,1,0];

let i=1;
let j=0;
let k=1;
let indiceAnterior =0;
let puntos=0;

let respUser = nameUser +'/';

const botonAceptar = document.createElement("button");
botonAceptar.id = "aceptar";
botonAceptar.textContent ="Aceptar respuesta";
document.querySelector(".preguntas").appendChild(botonAceptar);

const botonSiguiente = document.createElement("button");
botonSiguiente.id = "siguiente";
botonSiguiente.textContent ="Siguiente pregunta";

const totalPuntos = document.createElement("p");

let labels = document.querySelectorAll("label");

let items = document.querySelectorAll('input[type="radio"]');

let pregunta = document.querySelector("#pregunta");

let nombre = document.querySelector("#nombre");
nombre.innerHTML = `${nombre.innerHTML} <em><strong>${nameUser}</em></strong> `;

let mensaje = document.querySelector("#feedback");

let aceptar = document.querySelector("#aceptar");
aceptar.addEventListener("click", function aceptarRespuesta(e){
    let sw=0;

    items.forEach((e)=>{
        if(e.checked){
            respUser += e.id +'-';
            sw=1;
        }
    });

    if(sw==0){
        respUser += 'No respondio' +'-';
    }

    if(items[opc[j++]].checked){
        puntos++;
        mensaje.innerHTML = "Correcta!!";
    }
    else{
        mensaje.innerHTML = "Incorrecta!!";
    }
    
    if(i==10){
        respUser += '/'+puntos +'/';

        let fin = new Date();
        let transcurso = msToTime(fin.getTime() - inicio.getTime());

        let horaTermino = fin.getHours() + ':' + fin.getMinutes() + ':' + fin.getSeconds();
        respUser += transcurso +'/';
        respUser += horaTermino +'/';

        let fechaTermino = fin.getFullYear()+':'+(fin.getMonth()+1)+':'+fin.getDate();
        respUser += fechaTermino;

        fetch('./guardarResul.php',{
            method: "POST",
            mode: "same-origin",
            credentials: "same-origin",
            headers: {
              "Content-Type": "application/json"
            },
            body: JSON.stringify({respUser: respUser})
        })
        .then(res => res.json())
        .then(data => {
            console.log(data);
        });

        j=0;
        i=1;
        document.querySelector(".preguntas").appendChild(totalPuntos);
        totalPuntos.innerHTML = `Puntaje obtenido: ${puntos}</br>
        Tiempo invertido: ${transcurso}`;

        aceptar.removeEventListener("click",aceptarRespuesta);
        botonAceptar.remove();

        botonSiguiente.textContent ="Ver la práctica desarrollada correctamente";
        document.querySelector(".preguntas").appendChild(botonSiguiente);

        botonSiguiente.addEventListener("click",function verPractica(e){
            botonSiguiente.textContent ="Siguiente";
            pregunta.innerHTML= preg[0];
            labels[0].style.color="green";
            items[0].checked =true;
            generarLabels();
            
            mensaje.remove();

            botonSiguiente.removeEventListener("click",verPractica);
            totalPuntos.remove();

            e.target.addEventListener("click",function mostrarResultados(e){
                if(k != 10){
                    if(indiceAnterior != opc[k]){
                        labels[indiceAnterior].style.color = "black";
                        labels[opc[k]].style.color = "green";
                        items[opc[k]].checked = true;

                        indiceAnterior = opc[k];

                        pregunta.innerHTML= preg[i++];
                        j++;
                        generarLabels();
                        k++;
                    }
                    else{
                        pregunta.innerHTML= preg[i++];
                        j++;
                        generarLabels();
                        k++;
                    }
                }
                else{
                    botonSiguiente.textContent ="FIN";
                    e.target.removeEventListener("click",mostrarResultados);
                    window.location.replace("./index.php");
                }
            });
        });

    }
    else{
        
        aceptar.removeEventListener("click",aceptarRespuesta);
        botonAceptar.remove();
        
        document.querySelector(".preguntas").appendChild(botonSiguiente);

        botonSiguiente.addEventListener("click", function siguientePregunta(e){
            pregunta.innerHTML= preg[i++];
            generarLabels();
            botonSiguiente.remove();
            botonSiguiente.removeEventListener("click",siguientePregunta);
            mensaje.innerHTML = "";
            document.querySelector(".preguntas").appendChild(botonAceptar);
            aceptar.addEventListener("click",aceptarRespuesta);
        });
    }

});

//Generar labels -- Modulo aparte
function generarLabels(){
    let partesResp= resp[i-1].split("-");

    labels[opc[j]].innerHTML = partesResp[0];

    if(opc[j] == 0){
        labels[2].innerHTML = partesResp[1];
        labels[1].innerHTML = partesResp[2];
    }
    else if(opc[j] == 1){

        labels[2].innerHTML = partesResp[1];
        labels[0].innerHTML = partesResp[2];
    }
    else{
        labels[0].innerHTML = partesResp[1];
        labels[1].innerHTML = partesResp[2];
    }
}