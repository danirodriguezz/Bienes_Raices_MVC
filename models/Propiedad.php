<?php
    declare(strict_types = 1);
    namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = "propiedades";
    protected static $columnasDB = ["id", "vendedor_id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", 
    "estacionamiento","creado"];

    public $id;
    public $vendedor_id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? NULL;
        $this->vendedor_id = $args["vendedor_id"] ?? "";
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamiento = $args["estacionamiento"] ?? "";
        $this->creado = date("Y/m/d");
    }

    public function validarErrores() :array {
        if(!$this->titulo) {
            self::$errores[] = "El titulo es obligatorio";
        }
        if(!$this->precio || $this->precio > 99999999 ) {
            self::$errores[] = "El apartado de precio esta mal introducido";
        }
        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es obligatorio y debe tener al menos 50 caracteres";
        }
        if(!$this->habitaciones) {
            self::$errores[] ="Debe introducir mínimo 1 habitación";
        }
        if(!$this->wc) {
            self::$errores[] = "El wc es obligatorio";
        }
        if(!$this->estacionamiento) {
            self::$errores[] = "El estacionamiento es obligatorio";
        }
        if(!$this->vendedor_id) {
            self::$errores[] = "Eliga un vendedor";
        }
        if(!$this->imagen) {
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        }
        
        return self::$errores;
    }

}