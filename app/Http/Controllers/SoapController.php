<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use App\Http\Models\Authentication as AuthPtP;
use SoapClient;

/**
 * Control para gestion de conesiones soap
 * 
 * @property string $wsdl
 * @property string $encoding
 */
class SoapController extends Controller
{
	/**
	 * $wsdl url del wsdl de carga.
	 * @var string
	 */
	protected $wsdl='https://api.placetopay.com/soap/pse/?wsdl'; //'https://test.placetopay.com/soap/pse/?wsdl';
	/**
	 * $encoding codificacion de caracteres estandar.
	 * @var string
	 */
	protected $encoding='UTF-8';
	/**
	 * Metodo para obtener valor de encoding.
     * @return string
     */
	public function getEncoging() { return $this->encoding; }
	/**
	 * Metodo para obtener valor de wsdl.
     * @return string
     */
	public function getWsdl() { return $this->wsdl; }
	
	/**
	 * Metodo para asignar valor a encoding.
     * @param string $encoding
     */
	public function setEncoging($encoding='') { $this->encoding=$encoding; }
	/**
	 * Metodo para asignar valor a wsdl.
     * @param string $wsdl
     */
	public function setWsdl($wsdl='') { $this->wsdl=$wsdl; }
	
	/**
	 * Metodo para obtener una lista de bancos consultada por soap, si esta cachada se devuelve el valor de cache.
     * @return array
     */
	public function getBankList() {
		$banks=false;
		$lista=array();
		$cache_id = 'bankList2';
		$minCache=1440; // 60*24 = dia (1440)
		try {	
				if (null === $banks = Cache::get($cache_id)) {
					$auth=new AuthPtP;
					$soapClient =  new SoapClient($this->wsdl, array('encoding' => $this->encoding));
					$result = $soapClient->getBankList($auth->getAuth());
					$banks = $result->getBankListResult->item;
					Cache::put($cache_id, $banks , $minCache);
				}
	    } catch (\Exception $e) {
	        	echo $e->getMessage();
	    }
        $banks = (is_array($banks) ? $banks : array());
		foreach($banks as $bank){
			$bank=(array)$bank;
			$lista[$bank['bankCode']]=$bank['bankName'];
		}
		
		return $lista;
	}
	
	/**
	 * Metodo para generar una transaction consumiendo el wsdl.
	 * @param object $transaccion
     * @return object|false
     */
	public function createTransaction($transaction) //PseTsRequest
	{
		$auth=new AuthPtP;
		$param = $auth->getAuth();
		$param['transaction']=(Object)$transaction;
		$transaction=false;
		
		try {
			$soapClient =  new SoapClient($this->wsdl, array('encoding' => $this->encoding));
	        $result = $soapClient->createTransaction($param);
	        $transaction = $result->createTransactionResult;
	    } catch (\Exception $e) {
			echo $e->getMessage();
	    }
	    return is_object($transaction) ? $transaction : false;
	}
	
	/**
	 * Metodo para consultar la informacion de una transaction de pago a partir de su ID.
	 * @param int $transactionID
     * @return object|false
     */
	public function getTransactionInformation($transactionID) {
		if (intval($transactionID) == 0){
			 return  new \Exception(" Invalido el $transactionID ");
		}
		$auth=new AuthPtP;
		$param = $auth->getAuth();
		$param['transactionID'] = $transactionID;
		$informacion = '';

		try {
			
			$soapClient =  new SoapClient($this->wsdl, array('encoding' => $this->encoding));
	        $result = $soapClient->getTransactionInformation($param);
	        $informacion = $result->getTransactionInformationResult;
			
	    } catch (\Exception $e) {
				echo $e->getMessage();
	    }
		
        return is_object($informacion) ? $informacion : false;
	}
	
	
}
