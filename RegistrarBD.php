<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="keyword" content="Ticket, ticketboost, ticketbooster, Ticketboost, reventa, revendedor, venta de tickets, entradas, entradas a conciertos, concierto, futbol, teatro">
    <meta name="description" content="Ticketboost S.A. es una compañía destinada a regular el mercado de reventa que tiende a ser descontrolado en muchos aspectos">
    <meta name="author" content="José Luis Quispe">
    <meta name="copyright" content="Fitfat S.A.">
    <link rel="icon" href="img/hoja.ico">
    <link rel="stylesheet" href="css/styles.css">
    <title>Ticketboost</title>
</head>

<body>
    <header></header>
    <section class="regisBD">
        <h1>Registro de Alimentos</h1>
        <form id="foodForm">
            <label for="foodName">Buscar Alimento:</label>
            <input type="text" id="foodName" required>
            <button type="submit">Buscar</button>
        </form>
        <div id="searchResults"></div>
        <h2>Lista de Alimentos Registrados</h2>
        <ul id="foodList"></ul>
    </section>
    <script>
        const foodForm = document.getElementById("foodForm");
        const foodNameInput = document.getElementById("foodName");
        const searchResults = document.getElementById("searchResults");
        const foodList = document.getElementById("foodList");

        // Función para buscar alimentos en la base de datos
        foodForm.addEventListener("submit", function (event) {
            event.preventDefault();

            const foodName = foodNameInput.value.toLowerCase();

            // Realiza una solicitud a un archivo PHP para buscar el alimento en la base de datos
            fetch('buscar_alimento.php?nombre=' + foodName)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        // Agrega el alimento y sus atributos a la lista de alimentos registrados
                        const foodItem = document.createElement("li");
                        foodItem.textContent = `
                            Nombre: ${data.nombre}
                            Calorías: ${data.calorias}
                            Proteínas: ${data.proteinas}
                            Carbohidratos: ${data.carbohidratos}
                            Grasas: ${data.grasas}
                        `;
                        foodList.appendChild(foodItem);

                        // Limpia el campo de búsqueda
                        foodNameInput.value = "";
                        searchResults.innerHTML = ""; // Limpia los resultados de búsqueda
                    } else {
                        // Muestra un mensaje si el alimento no se encuentra en la base de datos
                        searchResults.textContent = "Alimento no encontrado en la base de datos.";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
    <footer></footer>
    <script src="js/script.js"></script>
</body>
</html>
