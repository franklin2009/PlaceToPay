<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de tabla placetopays
 * 
 * @property int $id
 * @property int $transactionID
 * @property string $sessionID
 * @property string $returnCode
 * @property string $trazabilityCode
 * @property int $transactionCycle
 * @property string $bankCurrency
 * @property float $bankFactor
 * @property string $bankURL
 * @property int $responseCode
 * @property string $responseReasonCode
 * @property string $responseReasonText
 * @property string $estatus
 * @property string $created_at
 * @property string $updated_at
 */
class PlaceToPay extends Model
{
	/**
	 * $table nombre de la tabla que gestiona el modelo.
	 * @var string
	 */
	protected $table = 'placetopays';
	/**
	 * $fillable  array de elementos accesibles por el modelo
	 * @var array
	 */
    protected $fillable = ['transactionID', 'sessionID', 'returnCode', 'trazabilityCode', 'transactionCycle', 'bankCurrency', 'bankFactor', 'bankURL', 'responseCode', 'responseReasonCode', 'responseReasonText', 'estatus', 'created_at', 'updated_at'];
	
}
