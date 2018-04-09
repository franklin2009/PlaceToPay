<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\SoapController as Soap;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Models\PlaceToPay as PtoPay;
use Illuminate\Pagination\Paginator;

/**
 * Control para gestion de paginas: vistas y logica del ejercicio
 * 
 */
 
class PageController extends Soap
{
	
	/**
	 * Metodo para visualizar la vista del home.
     * @return view
     */
	public function home() {
		return view('home');
	}
	
	/**
	 * Metodo para visualizar la vista del about.
     * @return view
     */
	public function about() {
		$avatar = "https://www.gravatar.com/avatar/" . md5('franklin.archila@gmail.com'). "&s=80";
		return view('about')->with('avatar',$avatar);
	}
	
	/**
	 * Metodo para visualizar la vista de la forma de pago pse (formPse).
     * @return view
     */
	public function formPse() {
		$listCuenta=array(0=>'Persona',1=>'Empresa');
		$listBanco=$this->getBankList();
		$listPais=array('CO'=>'Colombia');
		$listCiudad=array('Bucaramanga'=>'Bucaramanga','Giron'=>'Giron','Piedecuesta'=>'Piedecuesta','Floridablanca'=>'Floridablanca');
		$listDepartamento=array('Santander'=>'Departamento Santander');
		$listDocumento=array('CC'=>'Cedula de Ciudadania','CE'=>'Cedula de Extrangero','TI'=>'TI ?','PPN'=>'PPN ?','NIT'=>'NIT ?','SSN'=>'SSN ?');
		return view('formPse', compact('listCuenta','listBanco','listPais','listCiudad','listDepartamento','listDocumento'));
	}
	
	/**
	 * Metodo para visualizar la lista de pagos realizados
     * @return view
     */
	public function listPago() {
		$paginacion = 8;
		$lista=PtoPay::orderBy('transactionID', 'desc') -> paginate($paginacion);
		return view('listPago', compact('lista'));
	}
	
	
	/**
	 * Metodo que gestiona logica/control de la transaccion de pago pse. Si hay un error retorna la vista de formPse.
	 * @param Request $request
     * @return view|none
     */
	public function createTransacion(Request $request) {
		$payer=array();
		$pseTr=array();
		$buyer=array();
		$shipping=array();
		$message=array('alert' => 'warning', 'info' => '!Disculpa!', 'titulo' => ' No se pudo procesar transaccion ', 'texto' => ' Intenta mas tarde la operacion', 'error' => '');
		
		$payer['document']=$request->input('py-document');
		$payer['documentType']=$request->input('py-documentType');
		$payer['firstName']=$request->input('py-firstName');
		$payer['lastName']=$request->input('py-lastName');
		$payer['company']=$request->input('py-company');
		$payer['emailAddress']=$request->input('py-emailAddress');
		$payer['address']=$request->input('py-address');
		$payer['city']=$request->input('py-city');
		$payer['province']=$request->input('py-province');
		$payer['country']=$request->input('py-country');
		$payer['phone']=$request->input('py-phone');
		$payer['mobile']=$request->input('py-mobile');
		
		$buyer=$payer;
		
		$dataRs=array('bankCode'=>$request->input('bk-bankCode'),'bankInterface'=>$request->input('bk-bankInterface'),'ip'=>$request->ip(),'userAgent'=>$request->header('User-Agent'));
		$pseTr=$this->demoTransactionRequest($dataRs);
		
		$shipping=$this->demoShipping();
		
		$validPersona = $this->validarPersona($payer);
		if ($validPersona != null) {
			return back() -> withInput() -> withErrors($validPersona);
		}
		$validShipp = $this->validarPersona($shipping);
		if ($validShipp != null) {
			return back() -> withInput() -> withErrors($validShipp);
		}
		$validBanco = $this->validarBanco($pseTr);
		if ($validBanco != null) {
			return back() -> withInput() -> withErrors($validBanco);
		}
		
		$transaction=$pseTr;
		$transaction['payer']=$payer;
		$transaction['buyer']=$buyer;
		$transaction['shipping']=$shipping;
		$transaccion=$this->createTransaction($transaction);
		if($transaccion){
			$this->ptoPayCreate($transaccion);
			if($transaccion->returnCode=="SUCCESS"){
				return  Redirect::to($transaccion->bankURL);
			}
		}
		Session::flash('message', (Object)$message);
		return back() -> withInput();
	}
	
	/**
	 * Metodo que valida los datos de banco/transaccion a nivel de backend.
	 * @param array $data
     * @return validate|null
     */
	function validarBanco($data=array()){
		$rules=[
				'bankCode' => 'max:4',
				'bankInterface' => 'max:1|in:0,1',
				'returnURL' => 'max:255',
				'reference' => 'max:32',
				'description' => 'max:255',
				'language' => 'max:2',
				'currency' => 'max:3',
				'ipAddress' => 'ip',
				'userAgent' => 'max:255',
		];
		$messages=[
				'bankCode.max' => 'Codigo de Banco tiene mas de :max caracteres',
				'bankInterface.max' => 'Tipo de cuenta tiene mas de :max caracter',
				'bankInterface.in' => 'Valor invalido para Tipo de Cuenta',
				'returnURL.max' => 'Url de retorno tiene mas de :max caracteres',
				'reference.max' => 'Referencia tiene mas de :max caracteres',
				'description.max' => 'Descripcion tiene mas de :max caracteres',
				'language.max' => 'Codigo de Lenguaje tiene mas de :max caracteres',
				'currency.max' => 'Codigo de Moneda tiene mas de :max caracteres',
				'ipAddress.ip' => 'Valor de ip invalido',
				'userAgent.max' => 'userAgent tiene mas de :max caracteres',
		];
		$validate = Validator::make($data, $rules, $messages);
		if ($validate -> fails()) return $validate;
		else return null;
	}
	
	/**
	 * Metodo que valida los datos de personas a nivel de backend.
	 * @param array $data
     * @return validate|null
     */
	function validarPersona($data=array()){
		$rules=[
				'document' => 'max:12',
				'documentType' => 'max:3|in:"CC","CE","TI","PPN","NIT","SSN"',
				'firstName' => 'max:60',
				'lastName' => 'max:60',
				'company' => 'max:60',
				'emailAddress' => 'max:80|email',
				'city' => 'max:50',
				'province' => 'max:50',
				'country' => 'max:2',
				'phone' => 'max:30',
				'mobile' => 'max:30',
		];
		
		$messages=[
				'document.max' => 'Documento tiene mas de :max caracteres',
				'documentType.in' => 'Valor invalido para Tipo de Documentos',
				'documentType.max' => 'Tipo de Documento tiene mas de :max caracteres',
				'firstName.max' => 'Nombre tiene mas de :max caracteres',
				'lastName.max' => 'Apellido tiene mas de :max caracteres',
				'company.max' => 'Empresa tiene mas de :max caracteres',
				'emailAddress.max' => 'Email tiene mas de :max caracteres',
				'emailAddress.email' => 'Email no tiene formato valido',
				'city.max' => 'Ciudad tiene mas de :max caracteres',
				'province.max' => 'Departamento tiene mas de :max caracteres',
				'country.max' => 'Pais tiene mas de :max caracteres',
				'phone.max' => 'Telefono tiene mas de :max caracteres',
				'mobile.max' => 'Celular tiene mas de :max caracteres',
		];

		$validate = Validator::make($data, $rules, $messages);
		if ($validate -> fails()) return $validate;
		else return null;
	}
	
	/**
	 * Metodo que genera data de pruebas de persona receptora.
     * @return array
     */
	function demoShipping(){
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
	 * Metodo que genera data de pruebas de banco/transaccion.
	 * @param array $rq
     * @return array
     */
	function demoTransactionRequest($rq=array()){
		$pseTr=array();
		$pseTr['bankCode']=$rq['bankCode'];
		$pseTr['bankInterface']=$rq['bankInterface'];
		$pseTr['returnURL']='http://localhost/public/transaccion';
		$pseTr['reference']=date('ymdHis');
		$pseTr['description']='Pago Prueba - '.$pseTr['reference'];
		$pseTr['language']='ES';
		$pseTr['currency']='COP';
		$pseTr['ipAddress']=$rq['ip'];
		$pseTr['userAgent']=$rq['userAgent'];
		$pseTr['totalAmount']=20000.00;
		$pseTr['taxAmount']=0.00;
		$pseTr['devolutionBase']=0.00;
		$pseTr['tipAmount']=0.00;
		$pseTr['additionalData']='';
		return $pseTr; 
	}
	
	
	/**
	 * Metodo logica/control de respuesta de la transaccion
     * @return view
     */
	public function transaccion() {
		if(Session::has('lastPtoPay')){
			$transactionID=Session::get('lastPtoPay')->transactionID;
			$informacion=$this->getTransactionInformation($transactionID);
			//returnCode (SUCCESS, FAIL..) responseReasonText, bankProcessDate, transactionState (OK, NOT_AUTHORIZED, PENDING, FAILED)
			return view('transaccion')->with('informacion',$informacion);
		} else{
			return redirect('/');
		}
	}
	
	/**
	 * Metodo para gestionar datos de transaccion a registrar en base de datos
	 * @param object $transaccion
     * @return object PtoPay
     */
	public function ptoPayCreate($transaccion) {
		$data=array();
		$data['returnCode']=(isset($transaccion->returnCode)?$transaccion->returnCode:'Error!');
		$data['bankURL']=(isset($transaccion->bankURL)?$transaccion->bankURL:'');
		$data['trazabilityCode']=(isset($transaccion->trazabilityCode)?$transaccion->trazabilityCode:'');
		$data['transactionCycle']=(isset($transaccion->transactionCycle)?$transaccion->transactionCycle:'');
		$data['transactionID']=(isset($transaccion->transactionID)?$transaccion->transactionID:'');
		$data['sessionID']=(isset($transaccion->sessionID)?$transaccion->sessionID:'');
		$data['bankCurrency']=(isset($transaccion->bankCurrency)?$transaccion->bankCurrency:'');
		$data['bankFactor']=(isset($transaccion->bankFactor)?$transaccion->bankFactor:'');
		$data['responseCode']=(isset($transaccion->responseCode)?$transaccion->responseCode:'');
		$data['responseReasonCode']=(isset($transaccion->responseReasonCode)?$transaccion->responseReasonCode:'');
		$data['responseReasonText']=(isset($transaccion->responseReasonText)?$transaccion->responseReasonText:'');
		$ptp=PtoPay::create($data);
		Session::put('lastPtoPay', (Object)array('id'=>$ptp->id,'transactionID'=>$ptp->transactionID));
		return $ptp;
	}
	
}
