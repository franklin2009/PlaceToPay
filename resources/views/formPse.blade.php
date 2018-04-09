@extends('layouts.publico')

@section('my-contenido')

      <div class="jumbotron">
        <h2>Formulario Pse</h2>
        <p class='alert alert-info' >
				Pago de producto simulado por valor de <b>20.000,00 COL</b>
		</p>
        
			{{ Form::open(array('url' => 'createTransacion' ,'method' =>'Post' , "id" => "form-pse", "data-smk-icon" => "glyphicon-remove")) }}
				
			<div class="row">
			
				<div class="form-group col-md-2">
					<label for="py-documentType">Tipo Documento:</label>
					{{ Form::select('py-documentType', $listDocumento, '' , ['class' => 'form-control', 'id' => 'py-documentType', 'placeholder'=>'Seleccione Tipo Documento', 'title'=>'Tipo de Documento' , "required"]) }}
				</div>
				
				<div class="form-group col-md-10">
					<label for="py-document">Documento:</label>
					{{ Form::text('py-document', '' , ['class' => 'form-control', 'id' => 'py-document' , 'placeholder'=>'Documento' , 'maxlength'=>12, 'required' ]) }}
				</div>
				
			</div>
			
			<div class="row">
				<div class="form-group col-md-6">
					<label for="py-firstName">Nombre:</label>
					{{ Form::text('py-firstName', '' , ['class' => 'form-control', 'id' => 'py-firstName' , 'placeholder'=>'Nombre' , 'maxlength'=>60, 'required' ]) }}
				</div>
				
				<div class="form-group col-md-6">
					<label for="py-lastName">Apellido:</label>
					{{ Form::text('py-lastName', '' , ['class' => 'form-control', 'id' => 'py-lastName' , 'placeholder'=>'Apellido' , 'maxlength'=>60, 'required' ]) }}
				</div>
			</div>

			<div class="row">
				
				<div class="form-group col-md-6">
					<label for="py-emailAddress">Email:</label>
					{{ Form::email('py-emailAddress', '' , ['class' => 'form-control', 'id' => 'py-emailAddress' , 'placeholder'=>'Email' , 'maxlength'=>80, 'required' ]) }}
				</div>
				
				<div class="form-group col-md-6">
					<label for="py-company">Empresa:</label>
					{{ Form::text('py-company', '' , ['class' => 'form-control', 'id' => 'py-company' , 'placeholder'=>'Empresa' , 'maxlength'=>60, 'required' ]) }}
				</div>
				
			</div>		
			
			<div class="row">
				<div class="form-group col-md-12">
					<label for="py-address">Direccion:</label>
					{{ Form::text('py-address', '' , ['class' => 'form-control', 'id' => 'py-address' , 'placeholder'=>'Direccion' , 'maxlength'=>100, 'required' ]) }}
				</div>
			</div>
				
			<div class="row">	
				<div class="form-group col-md-4">
					<label for="py-country">Pais:</label>
					{{ Form::select('py-country', $listPais, '' , ['class' => 'form-control', 'id' => 'py-country', 'placeholder'=>'Seleccione un Pais', 'title'=>'Pais' , "required"]) }}
				</div>
				
				<div class="form-group col-md-4">
					<label for="py-province">Departamento / Provincia:</label>
					{{ Form::select('py-province', $listDepartamento, '' , ['class' => 'form-control', 'id' => 'py-province', 'placeholder'=>'Seleccione un Departamento', 'title'=>'Departamento' , "required"]) }}
				</div>
				
				<div class="form-group col-md-4">
					<label for="py-city">Ciudad:</label>
					{{ Form::select('py-city', $listCiudad, '' , ['class' => 'form-control', 'id' => 'py-city', 'placeholder'=>'Seleccione una Ciudad', 'title'=>'Ciudad' , "required"]) }}
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-6">
					<label for="py-phone">Telefono:</label>
					{{ Form::tel('py-phone', '' , ['class' => 'form-control', 'id' => 'py-phone' , 'placeholder'=>'Telefono' , 'maxlength'=>30, 'required' ]) }}
				</div>
				
				<div class="form-group col-md-6">
					<label for="py-mobile">Celular:</label>
					{{ Form::tel('py-mobile', '' , ['class' => 'form-control', 'id' => 'py-mobile' , 'placeholder'=>'Celular' , 'maxlength'=>30, 'required' ]) }}
				</div>
			</div>
				
			
			<div class="row">
				<div class="form-group col-md-6">
					<label for="bk-bankInterface">Tipo de cuenta:</label>
					{{ Form::select('bk-bankInterface', $listCuenta, '' , ['class' => 'form-control', 'id' => 'bk-bankInterface', 'placeholder'=>'Seleccione Tipo Cuenta', 'title'=>'Tipo de Cuenta' , "required"]) }}
				</div>
				
				<div class="form-group col-md-6">
					<label for="bk-bankCode">Entidad Financiera:</label>
					{{ Form::select('bk-bankCode', $listBanco, '' , ['class' => 'form-control', 'id' => 'bk-bankCode', 'placeholder'=>'Seleccione un Banco', 'title'=>'Banco' , "required"]) }}
				</div>
			</div>	
				
				<button type="submit" id="btn-form-pse" class="btn btn-md btn-primary"> Pagar </button>
						
			{{ Form::close() }}
			
      </div>

	  
@endsection