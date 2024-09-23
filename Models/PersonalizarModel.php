<?php

class PersonalizarModel extends Query {

    public function __construct() {
        parent::__construct(); // Llamar al constructor de la clase padre
    }

    public function saveImagePath($fileName) {
        try {
            $sql = "INSERT INTO images (image_path) VALUES (:image_path)";
            $stmt = $this->db->prepare($sql); // Asegúrate de tener acceso a la conexión de base de datos
            $stmt->bindParam(':image_path', $fileName);
            if (!$stmt->execute()) {
                throw new Exception('Error al guardar la ruta de la imagen.');
            }
            return true; // Retorna true si se guardó correctamente
        } catch (Exception $e) {
            // Manejo de errores
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            return false; // Retorna false si hay un error
        }
    }

    // Aquí podrías agregar otros métodos relacionados con las personalizaciones, como obtener imágenes, etc.
}
?>
