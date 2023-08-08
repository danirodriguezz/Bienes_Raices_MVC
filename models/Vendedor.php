<?php

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = "vendedores";
    protected static $columnasDB = ["id", "nombre", "apellido", "telefono"];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? NULL;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
    }

    public function validarErrores() :array { 
        if(!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
        if(!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }
        if(!$this->telefono || !ctype_digit($this->telefono) || strlen($this->telefono) != 9) {
            self::$errores[] = "Teléfono no valido, tiene que tener 9 dígitos";
        }
        return self::$errores;
    }
}