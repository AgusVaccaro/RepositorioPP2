<?php
require_once "includes/db.php";

// Obtener las carreras únicas de la base de datos
$sql_carreras = "SELECT DISTINCT carrera FROM documentos";
$result_carreras = $conn->query($sql_carreras);
$carreras = array();

if ($result_carreras->num_rows > 0) {
    while ($row_carrera = $result_carreras->fetch_assoc()) {
        $carreras[] = $row_carrera["carrera"];
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Documentos - Repositorio Académico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.js"></script>
    <style>
        .documentos-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Mosaico con ancho mínimo de 250px */
            grid-gap: 20px; /* Espacio entre los documentos */
            justify-items: center;
            align-items: start; /* Asegura la alineación superior */
        }

        .documento {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .pdf-viewer {
            max-width: 100%;
        }

        .return-button {
            margin-bottom: 20px;
        }

        /* Estilos para las pestañas de carreras */
        .carreras-tab {
            display: inline-block;
            margin: 10px;
            cursor: pointer;
        }

        .carreras-tab.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <center>
        <h1>Documentos en el Repositorio Académico</h1>
        <a href="index.php" class="return-button">Volver a inicio</a>

        <!-- Pestañas para alternar entre las carreras -->
        <div id="carreras-tabs">
            <?php
            foreach ($carreras as $carrera) {
                echo '<span class="carreras-tab" data-carrera="' . $carrera . '">' . $carrera . '</span>';
            }
            ?>
        </div>

        <!-- Contenedor de documentos -->
        <div class="documentos-container" id="documentos-container">
            <!-- Documentos se cargarán aquí -->
        </div>
    </center>

    <script>
        // Script para alternar entre carreras al hacer clic en las pestañas
        const carrerasTabs = document.querySelectorAll(".carreras-tab");
        const documentosContainer = document.getElementById("documentos-container");

        carrerasTabs.forEach(tab => {
            tab.addEventListener("click", () => {
                const carrera = tab.getAttribute("data-carrera");

                // Remover la clase "active" de todas las pestañas
                carrerasTabs.forEach(t => t.classList.remove("active"));

                // Agregar la clase "active" a la pestaña seleccionada
                tab.classList.add("active");

                // Cargar documentos de la carrera seleccionada
                loadDocumentsByCarrera(carrera);
            });
        });

        // Función para cargar documentos de una carrera específica
        function loadDocumentsByCarrera(carrera) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `includes/get_documents_by_carrera.php?carrera=${carrera}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    documentosContainer.innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }
    </script>
</body>
</html>
