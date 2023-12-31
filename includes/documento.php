<?php
require_once "db.php";

class Documento {
    private $id;
    private $titulo;
    private $usuario_id;
    private $autor;
    private $categoria;
    private $fecha_de_carga;
    private $archivo;
    private $materia;
    private $carrera;

    public function __construct($id, $titulo, $usuario_id, $autor, $categoria, $fecha_de_carga, $archivo, $materia, $carrera) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->usuario_id = $usuario_id;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->fecha_de_carga = $fecha_de_carga;
        $this->archivo = $archivo;
        $this->materia = $materia; 
        $this->carrera = $carrera;
    }
    

    public function getId() {
        return $this->id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getUsuario_ID() {
        return $this->usuario_id;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getFecha_De_Carga() {
        return $this->fecha_de_carga;
    }

    public function getArchivo() {
        return $this->archivo;
    }

    public function getMateria() {
        return $this->materia;
    }

    public function getCarrera() {
        return $this->carrera;
    }

    public function cargarDocumento($archivoTemporal) {
        if (!is_uploaded_file($archivoTemporal)) {
            return "Error: No se ha subido el archivo correctamente.";
        }

        $directorioDestino = "uploads/";
        $archivoDestino = $directorioDestino . $this->archivo;

        if (!move_uploaded_file($archivoTemporal, $archivoDestino)) {
            return "Error: No se pudo mover el archivo al destino.";
        }

        $conn = conexionDB();

        $sql = "INSERT INTO documentos (titulo, autor, categoria, archivo, materia, carrera, fecha_de_carga) VALUES (?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssss", $this->titulo, $this->autor, $this->categoria, $this->archivo, $this->materia, $this->carrera);


        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return "Documento cargado y registrado en la base de datos con éxito.";
        } else {
            $stmt->close();
            $conn->close();
            return "Error al registrar el documento en la base de datos: " . $stmt->error;
        }
    }

    public function eliminarDocumento() {
        $conn = conexionDB();

        // Consulta SQL para obtener el nombre del archivo y el id
        $sql = "SELECT archivo FROM documentos WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Asigna el valor del id al parámetro
        $stmt->bind_param("i", $this->id);

        // Ejecuta la consulta
        $stmt->execute();

        // Vincula el resultado a una variable
        $stmt->bind_result($archivo);
        $stmt->fetch();
        $stmt->close();

        // Elimina el registro de la base de datos
        $sql = "DELETE FROM documentos WHERE id = ?";
        $stmt = $conn->prepare($sql);

        // Asigna el valor del id al parámetro
        $stmt->bind_param("i", $this->id);

        // Ejecuta la eliminación
        if ($stmt->execute()) {
            // Cierra la conexión
            $stmt->close();
            $conn->close();

            // Elimina el archivo del sistema de archivos
            $directorioDestino = "uploads/";
            $archivoDestino = $directorioDestino . $archivo;

            if (unlink($archivoDestino)) {
                return "Documento eliminado con éxito.";
            } else {
                return "Documento eliminado de la base de datos, pero no se pudo eliminar el archivo.";
            }
        } else {
            $stmt->close();
            $conn->close();
            return "Error al eliminar el documento de la base de datos: " . $stmt->error;
        }
    }
}
?>
