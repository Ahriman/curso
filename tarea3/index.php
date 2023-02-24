<?php 
    header('Location: listado.php');

/*
Para acceder a la base de datos se debe usar PDO. Controlaremos y mostraremos los posible errores. Para los estilos se recomienda usar Bootstrap.

// Pasaremos el código de producto por "get" tanto para "detalle.php" como para "update.php". Utilizando en el enlace "detalle.php?id=cod" .
// En ambas páginas comprobaremos que esta variable existe, si no redireccionaremos a "listado.php" para 
// esto podemos usar "header('Location:listado.php')"



// RECOMENDACIONES


// Recomendaciones:

//     // Además del manual online de PHP, se recomienda dar libre acceso a Internet para la búsqueda de información.
//     // Para no repetir el código de la conexión a la base de datos en cada archivo, se recomienda crear el archivo conexion.php y utilizar 
//     // require o require_once cada vez que lo necesitamos.
//     // Para borrar un producto, crea un formulario con el action apuntando a "borrar.php" y pasa por un campo oculto el código del producto a borrar.
//     // Recuerda que en el "option" del HTML "<option value="v">Nombre</option>",  "v" es el valor que pasamos, "Nombre" es lo que mostramos en la 
//     // lista desplegable.




    Indicaciones de entrega

    apellido1_apellido2_nombre_DWES03_Tarea







TODO: TRANSACCIONES???



    
Criterios de evaluación implicados

Se han analizado las tecnologías que permiten el acceso mediante programación a la información disponible en almacenes de datos.
// Se han creado aplicaciones que establezcan conexiones con bases de datos.
// Se ha recuperado información almacenada en bases de datos.
// Se ha publicado en aplicaciones Web la información recuperada.
// Se han utilizado conjuntos de datos para almacenar la información.
// Se han creado aplicaciones Web que permitan la actualización y la eliminación de información disponible en una base de datos.
Se han utilizado transacciones para mantener la consistencia de la información.
Se han probado y documentado las aplicaciones.

Valoración y puntuación

Rúbrica de la tarea

// En "listado.php", generar el listado de los productos y los botones funcionando, el botón borrar será el submit de un formulario cuyo action debe
// ser el indicado


// 2 puntos

// En "crear.php", generar el formulario funcional de creación del producto


// 2 puntos

// En "update.php" cargar el formulario y que sea funcional con todos los campos del producto en cuestión rellenos.


// 2 puntos

// Página "borrar.php" funcional con mensaje y botón para volver.


// 1 Punto

// Página "detalle.php", mostrando el detalle del producto seleccionado y el botón volver funcionando


// 1 Punto

// La lista de selección familia de la página "update.php" tiene seleccionada la familia del producto.


// 0.75 Puntos

Se utilizan correctamente las excepciones para controlar los posibles errores


0.5 Puntos

Introducir comentarios, legibilidad del código y diseño


0.75 Puntos


*/


?>