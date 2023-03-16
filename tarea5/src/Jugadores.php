<?php

    namespace Clases;

    use PDO;
    use PDOException;

    class Jugadores extends Conexion
    {
        //private $id;
        private $nombre;
        private $apellidos;
        private $dorsal;
        private $posicion;
        private $barcode;

        public function __construct()
        {
            parent::__construct(); // Inicializa la conexión a la base de datos
        }

        public function recuperarJugadores() 
        {
            $consulta = 'SELECT * FROM jugadores order by posicion, apellidos';
            $stmt = $this->conexion->prepare($consulta);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die('Error al recuperar productos: ' . $ex->getMessage());
            }

            $this->conexion = null;
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }


        public function existeDorsal($dorsal) 
        {
            $consulta = 'SELECT * FROM jugadores WHERE dorsal=:dorsal';
            $stmt = $this->conexion->prepare($consulta);

            try {
                $stmt->execute(['dorsal' => $dorsal]);
            } catch (PDOException $ex) {
                die('Error al comprobar dorsal: ' . $ex->getMessage());
            }

            if($stmt->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        }

        public function existeBarcode($barcode) 
        {
            $consulta = 'SELECT * FROM jugadores WHERE barcode=:barcode';
            $stmt = $this->conexion->prepare($consulta);

            try {
                $stmt->execute(['barcode' => $barcode]);
            } catch (PDOException $ex) {
                die('Error al comprobar barcode: ' . $ex->getMessage());
            }

            if($stmt->rowCount() == 0) {
                return false;
            } else {
                return true;
            }
        }

        public function create() 
        {
            $insert = 'INSERT INTO jugadores (nombre, apellidos, dorsal, posicion, barcode) VALUES (:nombre, :apellidos, :dorsal, :posicion, :barcode)';
            $stmt = $this->conexion->prepare($insert);

            try {
                $stmt->execute([
                    'nombre' => $this->nombre,
                    'apellidos' => $this->apellidos,
                    'dorsal' => $this->dorsal,
                    'posicion' => $this->posicion,
                    'barcode' => $this->barcode
                ]);
            } catch (PDOException $ex) {
                die('Error al insertar jugadores: ' . $ex->getMessage());
            }

            $this->conexion = null;
        }

        public function borrarTodo()
        {
            $delete = 'DELETE FROM jugadores';
            $stmt = $this->conexion->prepare($delete);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die('Error al borrar los jugadores: ' . $ex->getMessage());
            }

            $this->conexion = null;
        }

        public function tieneDatos() 
        {
            $consulta = 'SELECT * FROM jugadores';
            $stmt = $this->conexion->prepare($consulta);

            try {
                $stmt->execute();
            } catch (PDOException $ex) {
                die('Error al comprobar si hay datos: ' . $ex->getMessage());
            }

            if($stmt->rowCount() == 0) {
                $this->conexion = null;
                return false;
            } else {
                $this->conexion = null;
                return true;
            }
        }

        // Setters

        /**
         * Set the value of nombre
         */
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;
        }

        /**
         * Set the value of apellidos
         */
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;
        }

        /**
         * Set the value of dorsal
         */
        public function setDorsal($dorsal)
        {
                $this->dorsal = $dorsal;

                return $this;
        }

        /**
         * Set the value of posicion
         */
        public function setPosicion($posicion)
        {
            $this->posicion = $posicion;
        }

        /**
         * Set the value of barcode
         */
        public function setBarcode($barcode)
        {
            $this->barcode = $barcode;
        }
    }
    

?>