<?php

namespace App\Http\Models;

/**
 * Modelo que contiene la informacion de registro de autorizacion
 * 
 * @property string $login
 * @property string $tranKey
 * @property string $seed
 * @property array $additional
 */
class Authentication
{
	/**
	 * $login Identificador habilitado para el consumo del API, entregado por Place to Pay. string[32]
	 * @var string
	 */
    protected $login;
    /**
	 * $tranKey Llave transaccional para el consumo del API   SHA1(seed + tranKey)  string[40]
	 * @var string
	 */
    protected $tranKey;
    /**
	 * $seed  Semilla usada para el consumo del API en el  proceso del hash por SHA1 del tranKey, ISO8601. string
	 * @var string
	 */
    protected $seed;
    /**
	 * $additional Datos adicionales a la estructura de autenticación
	 * @var array( Attribute , ...)
	 */
    protected $additional;
	
	/**
	 * Metodo constructor de la clase Auth
	 */
	function __construct() {
		$tranKey='024h1IlD';
		$this->login='6dd490faf9cb87a9862245da41170ff2';
		$this->seed=date('c');
		$this->tranKey=sha1( $this->seed . $tranKey , false );
	    $this->additional=array();
	}
   
	/**
	 * Metodo para inicializar atributos de la  clase Auth
	 * @param string $login
	 * @param string $tranKey
	 * @param string $seed
	 * @param array $additional
	 */
	public function init($login='6dd490faf9cb87a9862245da41170ff2', $tranKey='024h1IlD', $seed='', $additional=array()) {
		$this->login=$login;
		$this->seed=($seed=='' ? date('c') : $seed);
		$this->tranKey=sha1( $seed . $tranKey , false );
	    $this->additional='';
	}
	
	/**
	 * Metodo  que retorna un arreglo de  Auth
	 * @return array
	 */
	public  function getAuth($isFlat=true) {
		return ($isFlat ? array('auth' => $this) : $this);
	}
	
	/**
	 * Metodo para obtener valor de login.
     * @return string
     */
	public function getLogin(){ return $this->login; }
	/**
	 * Metodo para obtener valor de tranKey.
     * @return string
     */
	public function getTranKey(){ return $this->tranKey; }
	/**
	 * Metodo para obtener valor de seed.
     * @return string
     */
	public function getSeed(){ return $this->seed; }
	/**
	 * Metodo para obtener valor de additional.
     * @return array
     */
	public function getAdditional(){ return $this->additional; }
	
	/**
	 * Metodo para asignar valor a login.
     * @param string $login
     */
	public function setLogin($login=''){  $this->login=$login; }
	/**
	 * Metodo para asignar valor a tranKey.
     * @param string $tranKey
     */
	public function setTranKey($tranKey=''){  $this->tranKey=$tranKey; }
	/**
	 * Metodo para asignar valor a seed.
     * @param string $seed
     */
	public function setSeed($seed=''){  $this->seed=$seed; }
	/**
	 * Metodo para asignar valor a additional.
     * @param array $additional
     */
	public function setAdditional($additional=array()){  $this->additional=$additional; }
	
	
}
