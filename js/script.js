
const header=document.querySelector("header");
header.innerHTML=`
<nav>
<div>
    <ul>
        <li><a href="index.html">INICIO</a></li>
        <li><a href="nosotros.html">NOSOTROS</a></li>
        <li><a href="ingresa.html">INGRESA</a></li>
        <li><a href="beneficios.html">BENEFICIOS</a></li>
        <li><a href="precios.html">PRECIOS</a></li>
        <li><a href="comunidad.html">COMUNIDAD</a></li>
        <li><a href="app.html">APP</a></li>
    </ul>
</div>
</nav>

`;

// Crear el elemento footer
var footer = document.createElement('footer');
footer.style.backgroundColor = 'rgba(136, 61, 138, 255)';
footer.style.color = 'white';
footer.style.padding = '20px';
footer.style.textAlign = 'center';

// ...

// Agregar el texto al footer
var p = document.createElement('p');
p.textContent = '¿Te gustó? Póngase en contacto para registrarse e iniciar una consulta';
p.style.fontFamily = 'Abel';
p.style.color = '#000000';
p.style.fontSize = '30px';
p.style.marginBottom = '20px';
p.style.textAlign = 'center'; // Centra el texto horizontalmente
footer.appendChild(p);

// Agregar el texto de los servicios online
var p2 = document.createElement('p');
p2.textContent = 'Servicios online en todas nuestras redes asociadas';
p2.style.fontFamily = 'Abel';
p2.style.color = '#808080';
p2.style.fontSize = '20.2px';
p2.style.marginBottom = '20px';
footer.appendChild(p2);

// ...

// Crear una lista no ordenada (ul) para los iconos y textos
var ul = document.createElement('ul');
ul.style.listStyle = 'none'; // Quitar las viñetas de la lista
ul.style.display = 'flex'; // Aplicar flexbox
ul.style.flexDirection = 'column'; // Alinear los elementos en columna
ul.style.alignItems = 'center'; // Centrar horizontalmente
footer.appendChild(ul);


// Función para crear un elemento de lista con icono y texto
function crearListaIconoTexto(href, imgSrc, alt, texto, marginDerechoIcono, marginDerechoTexto) {
    var li = document.createElement('li');
  
    var a = document.createElement('a');
    a.href = href;
    a.style.display = 'flex';
    a.style.alignItems = 'center';
    li.appendChild(a);
  
    var img = document.createElement('img');
    img.src = imgSrc;
    img.alt = alt;
    img.style.marginRight = marginDerechoIcono;
    a.appendChild(img);
  
    var span = document.createElement('span');
    span.textContent = texto;
    span.style.color = 'white';
    span.style.marginRight = marginDerechoTexto;
    span.style.fontFamily = 'Abel'; // Cambia el tipo de letra a Abel
    span.style.fontSize = '22px'; // Cambia el tamaño de fuente a 25px
    a.appendChild(span);
  
    return li;
  }
  
  // Agregar los elementos de lista al footer
  ul.appendChild(crearListaIconoTexto('https://www.instagram.com/fitfat', 'img//ig.jpg', 'Instagram', '@fitfat', '10px', '5px'));
  ul.appendChild(crearListaIconoTexto('mailto:fitfat@gmail.com', 'img//email.jpg', 'Email', 'fitfat@gmail.com', '10px', '-85px'));
  ul.appendChild(crearListaIconoTexto('tel:01292463', 'img//tel.jpg', 'Teléfono', '994355129', '10px', '-38px'));

// Agregar la lista al footer
footer.appendChild(ul);

// Agregar el footer al final del body
document.body.appendChild(footer);







/*Menu Guia */

guia.addEventListener("click", (g) =>{
    g.preventDefault();
    const sectionG =document.querySelector(".guia");
    sectionG.scrollIntoView({behavior: "smooth"});
})

/*Menu Funcioens */

funciones.addEventListener("click", (f) =>{
    f.preventDefault();
    const sectionF =document.querySelector(".funciones");
    sectionF.scrollIntoView({behavior: "smooth"});
})
