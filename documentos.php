<?php
require_once "includes/db.php";

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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image/jpg" href="img/favicon.gif"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.js"></script>
    <style>
        .documentos-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); 
            grid-gap: 20px; 
            justify-items: center;
            align-items: start; 
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

        .carreras-tab {
            display: inline-block;
            margin: 10px;
            cursor: pointer;
        }

        .carreras-tab.active {
            font-weight: bold;
        }

        .documento-date {
            font-size: 0.8rem;
            margin-top: 5px;
            color: #666;
        }
    </style>
    
</head>
<body>
    <center>
        <h1>Documentos en el Repositorio Académico</h1>
        <a href="index.php" class="return-button">Volver a inicio</a>
        <div class="search-container">
            <form action="search.php" method="post" enctype="multipart/form-data">
                <input type="text" id="search-input" placeholder="Buscar documentos...">
                <div class="search-results" id="search-results"></div>
            </form>
        </div>
                    <?php
            foreach ($carreras as $carrera) {
                echo '<span class="carreras-tab" data-carrera="' . $carrera . '">' . $carrera . '</span>';
            }
            ?>
        </div>
    </form>

        <div class="documentos-container" id="documentos-container"></div>
    </center>

    <script>
        const carrerasTabs = document.querySelectorAll(".carreras-tab");
        const documentosContainer = document.getElementById("documentos-container");

        carrerasTabs.forEach(tab => {
            tab.addEventListener("click", () => {
                const carrera = tab.getAttribute("data-carrera");

                carrerasTabs.forEach(t => t.classList.remove("active"));

                tab.classList.add("active");

                loadDocumentsByCarrera(carrera);
            });
        });

        function loadDocumentsByCarrera(carrera) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `includes/doc_por_carrera.php?carrera=${carrera}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    documentosContainer.innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }

        const searchInput = document.getElementById("search-input");
        searchInput.addEventListener("keyup", function () {
            const query = searchInput.value;
            if (query.length >= 1) { 
                performSearch(query);
            }
        });

        function performSearch(query) {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `search.php?q=${query}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const searchResults = document.getElementById("search-results");
                    searchResults.innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }
    </script>
</body>
</html>
