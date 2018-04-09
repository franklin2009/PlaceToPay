<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PSETransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //PSETransactionRequest
			'ts-bankCode' => 'max:4',
            'ts-bankInterface' => 'max:1|containt:0,1',
            'ts-returnURL' => 'max:255',
            'ts-reference' => 'max:32',
            'ts-description' => 'max:255',
            'ts-language' => 'max:2',
            'ts-currency' => 'max:3',
            'ts-ipAddress' => 'ip',
            'ts-userAgent' => 'max:255',
			// Payer
			'py-document' => 'max:12',
            //'py-documentType' => 'max:3|containt:CC,CE,TI,PPN,NIT,SSN',
            'py-firstName' => 'max:60',
            'py-lastName' => 'max:60',
            'py-company' => 'max:60',
            'py-emailAddress' => 'max:80|email',
            'py-address' => 'max:100',
            'py-city' => 'max:50',
            'py-province' => 'max:50',
            'py-country' => 'max:2',
            'py-phone' => 'max:30',
            'py-mobile' => 'max:30',
			// buyer
			'by-document' => 'max:12',
            //'by-documentType' => 'max:3|containt:CC,CE,TI,PPN,NIT,SSN',
            'by-firstName' => 'max:60',
            'by-lastName' => 'max:60',
            'by-company' => 'max:60',
            'by-emailAddress' => 'max:80|email',
            'by-address' => 'max:100',
            'by-city' => 'max:50',
            'by-province' => 'max:50',
            'by-country' => 'max:2',
            'by-phone' => 'max:30',
            'by-mobile' => 'max:30',
			// shipping
			'sh-document' => 'max:12',
            //'sh-documentType' => 'max:3|containt:CC,CE,TI,PPN,NIT,SSN',
            'sh-firstName' => 'max:60',
            'sh-lastName' => 'max:60',
            'sh-company' => 'max:60',
            'sh-emailAddress' => 'max:80|email',
            'sh-address' => 'max:100',
            'sh-city' => 'max:50',
            'sh-province' => 'max:50',
            'sh-country' => 'max:2',
            'sh-phone' => 'max:30',
            'sh-mobile' => 'max:30',
        ];
    }
	
	/**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
	public function messages() {
		return [
			'titulo.required' => 'El :attribute es obligatorio.',
			'descripcion.required' => 'La :attribute es obligatoria',
			'ciudad.required' => 'La :attribute es obligatoria',
			'telefono.required' => 'El :attribute es obligatorio.',
			'latitud.required' => 'La :attribute es obligatoria',
			'longitud.required' => 'La :attribute es obligatoria',
			'subcategoria.required' => 'La :attribute es obligatoria',
			'tags.required' => 'Los :attribute son obligatorios',
		];
	}
}
