<?php

namespace Model;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    //Errores
    protected static $errores = [];

    public static function setDb($database) {
        self::$db = $database;
    }

    public function guardar() : bool{
        if(!is_null($this->id)) {
            //Actualizando
            $this->actualizar();
        } else {
            //Creando un nuevo registro
            return $this->crear();
        }
    }

    //Crear un registro
    public function crear() :bool {
        //Sanitizar los datos
        $datos = $this->sanitizarDatos();
        $string = join(", ",array_values($datos));
        //  Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(", ", array_keys($datos));
        $query .= " ) VALUES( '" ;
        $query .= join("', '",array_values($datos));
        $query .= "' ) ";
        $resultado = self::$db->query($query);
        return $resultado;
    }

    //Actualizar un registro
    public function actualizar() : void{
        $datos = $this->sanitizarDatos();
        $valores = [];
        foreach($datos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET "; 
        $query .= join(", ", $valores); 
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";
        
        $resultado = self::$db->query($query);
        if ($resultado) {
            header("Location: /admin?resultado=2");
            exit();
        }
    }

    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        
        if($resultado) {
            $this->borrarImagen();
            header("Location: /admin?resultado=3");
        }
    }

    //Esta funcion unicamente identifica  los atributos de la base de datos
    public function atributos() :array {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna == "id") continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos() :array {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Subida de archivos 
    public function setImagen($imagen) {
        //Eliminar la imagen previa 
        if(!is_null( $this->id )) {
            //Comprobar si existe el archivo
            $this->borrarImagen();
        }
        // Asignar al atributp imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar archivo
    public function borrarImagen() {
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo) {
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
    }

    //Validacion de errores
    public static function getErrores() :array {
        return static::$errores;
    }

    public function validarErrores() :array {
        static::$errores = [];
        return static::$errores;    
    }

    // Lista todos los registros
    public static function  all() :array {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Listar una cantidad especifica de registros
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT {$limite}";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    //Buscar un registro por su id 
    public static function find($id) : object{
        $query = "SELECT * FROM ". static::$tabla . " WHERE id = {$id};";
        $resultado = self::consultarSQL($query);
        if(empty($resultado)) {
            header("Location: /Bienes_raices/");
        } else {
            return array_shift($resultado) ;
        }
    }

    public static function consultarSQL($query) :array {
        //Consultar la base de datos 
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();
        // Retornar los resultados
        return $array;
    }

    public static function crearObjeto($registro) :object {
        $objeto = new static;
        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincronizar el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value ;
            }
        }
    }
}