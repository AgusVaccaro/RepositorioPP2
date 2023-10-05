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
    private $fecha_creacion;

    public function __construct($id, $titulo, $usuario_id, $autor, $categoria, $fecha_de_carga, $archivo, $materia, $carrera, $fecha_creacion) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->usuario_id = $usuario_id;
        $this->autor = $autor;
        $this->categoria = $categoria;
        $this->fecha_de_carga = $fecha_de_carga;
        $this->archivo = $archivo;
        $this->materia = $materia; 
        $this->carrera = $carrera;
        $this->fecha_creacion = $fecha_creacion;
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

    public function getFecha_Creacion() {
        return $this->fecha_creacion;
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
    
        $autores = implode(', ', $this->autor);
    
        $sql = "INSERT INTO documentos (titulo, autor, categoria, archivo, materia, carrera, fecha_de_carga, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
    
        $stmt = $conn->prepare($sql);
    
        $stmt->bind_param("sssssss", $this->titulo, $autores, $this->categoria, $this->archivo, $this->materia, $this->carrera, $this->fecha_creacion);
    
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


        $sql = "SELECT archivo FROM documentos WHERE id = ?";
        $stmt = $conn->prepare($sql);


        $stmt->bind_param("i", $this->id);


        $stmt->execute();

  
        $stmt->bind_result($archivo);
        $stmt->fetch();
        $stmt->close();


        $sql = "DELETE FROM documentos WHERE id = ?";
        $stmt = $conn->prepare($sql);


        $stmt->bind_param("i", $this->id);


        if ($stmt->execute()) {

            $stmt->close();
            $conn->close();


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
