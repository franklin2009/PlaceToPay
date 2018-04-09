<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\SoapController as Soap;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Models\PlaceToPay as PtoPay;
use App\Http\Controllers\PageController as Page;
use SoapClient;

/**
 * Control para hacer pruebas a la apliacion y soap
 * 
 */
 
class TestController extends Page
{
	
	/**
	 * Metodo para visualizar la vista del home.
     * @return view
     */
	public function show() {
		return view('test');
	}
	
	/**
	 * Metodo que gestiona logica/control de casos de pruebas.
	 * @param int $caso
     * @return view
     */
	public function test($caso=1) {
		switch($caso){
			case 1:
					//Validar conexion soap | OK
					$wsdl='https://api.placetopay.com/soap/pse/?wsdl';
					$encoding='UTF-8';
					$message=array('alert' => 'success', 'info' => '!Correcto!', 'titulo' => ' Validar conexion soap | OK ', 'texto' => ' ', 'error' => '');
					$soapClient = false;
					try{
						$soapClient =  new SoapClient($wsdl, array('encoding' => $encoding));
					} catch (\Exception $e) { $message['error'] = $e->getMessage();  }
					
					if(!$soapClient)  $message['error']='No se pudo generar conexion';
					Session::flash('message', (Object)$message);
					return  back();
			break;
			case 10:
					//Validar conexion soap | BAD
					$wsdl='https://api.placetopay.com/soap/pes/?wsdl';
					$encoding='UTF-8';
					$message=array('alert' => 'warning', 'info' => '!Disculpa!', 'titulo' => ' Validar conexion soap | BAD ', 'texto' => ' Intenta mas tarde la operacion', 'error' => '');
					$soapClient = false;
					try{
						$soapClient =  new SoapClient($wsdl, array('encoding' => $encoding));
					} catch (\Exception $e) { $message['error'] = $e->getMessage();  }
					if(!$soapClient)  $message['error']='No se pudo generar conexion';
					Session::flash('message', (Object)$message);
					return  back();
			break;
			case 2:
					//Validar lista de bancos
					$message=array('alert' => 'info', 'info' => '!Informacion!', 'titulo' => ' Validar lista de bancos ', 'texto' => ' ', 'error' => '');
					$soap=new Soap();
					$listBanco=$this->getBankList();
					if(count($listBanco) < 1 ) $message['texto']=' No hay bancos a listar';
					else $message['texto']=' Hay un total de '.count($listBanco).' bancos a listar';
					Session::flash('message', (Object)$message);
					return  back();
			break;
			case 3:
					//Validar datos personas | OK
					$message=array('alert' => 'success', 'info' => '!Correcto!', 'titulo' => ' Validar datos personas | OK', 'texto' => ' Datos Validados con exito ', 'error' => '');
					$validar=$this->validarPersona($this->demoPersonOk());
					if($validar!=null) $message['error']=' Hay error ';
					Session::flash('message', (Object)$message);
					if($validar!=null) return  back()-> withErrors($validar);
					else return  back();
			break;
			case 4:
					//Validar datos personas | Error
					$message=array('alert' => 'warning', 'info' => '!Error!', 'titulo' => ' Validar datos personas | Error ', 'texto' => ' Datos con error', 'error' => ' Verifique datos ingresados');
					$validar=$this->validarPersona($this->demoPersonBad());
					if($validar==null) $message['error']=' Deberia haber un error ';
					Session::flash('message', (Object)$message);
					if($validar!=null) return  back()-> withErrors($validar);
					else return  back();
			break;
			case 5:
					//Validar datos banco/transaccion | OK
					$message=array('alert' => 'success', 'info' => '!Correcto!', 'titulo' => ' Validar datos banco/transaccio | OK', 'texto' => ' Datos Validados con exito ', 'error' => '');
					$validar=$this->validarBanco($this->demoTrOk());
					if($validar!=null) $message['error']=' Hay error ';
					Session::flash('message', (Object)$message);
					if($validar!=null) return  back()-> withErrors($validar);
					else return  back();
			break;
			case 6:
					//Validar datos banco/transaccion | Error
					$message=array('alert' => 'warning', 'info' => '!Error!', 'titulo' => ' Validar datos banco/transaccio | Error ', 'texto' => ' Datos con error', 'error' => ' Verifique datos ingresados');
					$validar=$this->validarBanco($this->demoTrBad());
					if($validar==null) $message['error']=' Deberia haber un error ';
					Session::flash('message', (Object)$message);
					if($validar!=null) return  back()-> withErrors($validar);
					else return  back();
			break;
			case 7:
					//Validar pagos | total
					$message=array('alert' => 'info', 'info' => '!Informacion!', 'titulo' => ' Validar pagos | total ', 'texto' => ' ', 'error' => '');
					$pagos=PtoPay::all();
					if(count($pagos) < 1 ) $message['texto']=' No hay pagos a listar';
					else $message['texto']=' Hay un total de '.count($pagos).' pagos a listar';
					Session::flash('message', (Object)$message);
					return  back();
			break;
			case 8:
					//Validar trasaccion ID | Valido
					$id=1456757179;
					$message=array('alert' => 'success', 'info' => '!Correcto!', 'titulo' => ' Validar trasaccion ID | Valido ', 'texto' => ' Datos : ', 'error' => '');
					
					try{
						$informacion=$this->getTransactionInformation($id);
					} catch (\Exception $e) { $message['error'] = $e->getMessage();  }
					
					$message['texto'].=(isset($informacion->returnCode) ? ' Id: '.$id.' | '.$informacion->returnCode: ' NO HAY DATA. Id: '.$id);
					Session::flash('message', (Object)$message);
					return  back();
			break;
			case 9:
					//Validar trasaccion ID | No Valido
					$id='Az00122229';
					$message=array('alert' => 'warning', 'info' => '!Error!', 'titulo' => ' Validar trasaccion ID | No Valido ', 'texto' => ' Datos : ', 'error' => '');
					try{
						$informacion=$this->getTransactionInformation($id);
					} catch (\Exception $e) { $message['error'] = $e->getMessage();  }
					$message['texto'].=(isset($informacion->returnCode) ? ' Id: '.$id.' | '.$informacion->returnCode: ' NO HAY DATA. Id: '.$id);
					Session::flash('message', (Object)$message);
					return  back();
			break;
			default:
					// Caso invalido
					$message=array('alert' => 'warning', 'info' => '!Invalido!', 'titulo' => 'Caso de prueba no valido', 'texto' => ' ', 'error' => 'Intenta con un valor de 1 - 10');
					Session::flash('message', (Object)$message);
					return back();
			break;
			
		}
	}
	
	/**
	 * Metodo que genera data de pruebas de banco/transaccion. Datos Correctos
     * @return array
     */
	function demoTrOk(){
		$pseTr=array();
		$pseTr['bankCode']='01';
		$pseTr['bankInterface']=0;
		$pseTr['returnURL']='http://localhost/public/transaccion';
		$pseTr['reference']=date('ymdHis');
		$pseTr['description']='Pago Prueba - '.$pseTr['reference'];
		$pseTr['language']='ES';
		$pseTr['currency']='COP';
		$pseTr['ipAddress']='127.1.1.0';
		$pseTr['userAgent']='Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0';
		$pseTr['totalAmount']=20000.00;
		$pseTr['taxAmount']=0.00;
		$pseTr['devolutionBase']=0.00;
		$pseTr['tipAmount']=0.00;
		$pseTr['additionalData']='';
		return $pseTr; 
	}
	
	/**
	 * Metodo que genera data de pruebas de banco/transaccion. Datos Errados
     * @return array
     */
	function demoTrBad(){
		$pseTr=array();
		$pseTr['bankCode']='123456789';
		$pseTr['bankInterface']=0;
		$pseTr['returnURL']='http://localhost/public/transaccion';
		$pseTr['reference']=date('ymdHis');
		$pseTr['description']='Pago Prueba - '.$pseTr['reference'];
		$pseTr['language']='ESP';
		$pseTr['currency']='CO';
		$pseTr['ipAddress']='127.1.1.0';
		$pseTr['userAgent']='Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0';
		$pseTr['totalAmount']=20000.00;
		$pseTr['taxAmount']=0.00;
		$pseTr['devolutionBase']=0.00;
		$pseTr['tipAmount']=0.00;
		$pseTr['additionalData']='';
		return $pseTr; 
	}
	
	/**
	 * Metodo que genera data de pruebas de persona. Datos Correctos
     * @return array
     */
	function demoPersonOk(){
		$shipping=array();
		$shipping['document']='1127345000';
		$shipping['documentType']='CC';
		$shipping['firstName']='Franklin A';
		$shipping['lastName']='Archila';
		$shipping['company']='FA';
		$shipping['emailAddress']='franklin.archila@gmail.com';
		$shipping['address']='Carrera 9 #66-12';
		$shipping['city']='Bucaramanga';
		$shipping['province']='Santander';
		$shipping['country']='CO';
		$shipping['phone']='1238063630';
		$shipping['mobile']='1238063630';
		return $shipping;
	}
	
	/**
	 * Metodo que genera data de pruebas de persona. Datos Errados
     * @return array
     */
	function demoPersonBad(){
		$shipping=array();
		$shipping['document']='1127345000';
		$shipping['documentType']='CCDW';
		$shipping['firstName']='Franklin A';
		$shipping['lastName']='Archila';
		$shipping['company']='FA';
		$shipping['emailAddress']='franklin.archila';
		$shipping['address']='Carrera 9 #66-12';
		$shipping['city']='Bucaramanga';
		$shipping['province']='Santander';
		$shipping['country']='COL';
		$shipping['phone']='1238063630';
		$shipping['mobile']='1238063630';
		return $shipping;
	}
	
	
	
}
