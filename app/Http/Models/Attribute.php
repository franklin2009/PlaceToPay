<?php
namespace App\Http\Models;

/**
 * Modelo para almacenar informacion extendida.
 *
 */
class Attribute
{
	/**
	 * $name Codigo del atributo
	 * @var string
	 */
    protected $name;
    
    /**
	 * $value Valor del atributo
	 * @var string
	 */
    protected $value;
	
	/**
	 * Metodo para obtener valor de name.
     * @return string
     */
	public function getName(){ return $this->name; }
	
	/**
	 * Metodo para obtener valor de value.
     * @return string
     */
	public function getValue(){ return $this->value; }
	
	/**
	 * Metodo para asignar valor a name.
     * @param string $name
     */
	public function setName($name=''){  $this->name=$name; }
	
	/**
	 * Metodo para asignar valor a value.
     * @param string $value
     */
	public function setValue($value=''){  $this->value=$value; }
	
}
