@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
            <h3>Creacion de nuevo Periodo de planilla</h3>
            @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
        </div>
        
    </div> 
    
            {!!Form::open (array('url'=>'/planilla_ciclo','method'=>'POST','autocomplete'=>'off')) !!}
            
           
            {{Form::token()}}
    <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <input name="_token" value="{{csrf_token()}}" type="hidden"> </input>
                <button class="btn btn-primary" type="submit" >Guardar</button>
                <button class="btn btn-danger" type="reset" >cancelar</button>

            </div>
        </div>
    </div>
    <div class='row'>
    

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">    
                <label>Quicena</label>
                <select name="ID_Periodo"  class="form-control">               
                    <option value="1">Primera</option>
                    <option value="2">Segunda</option>
                </select>    

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">    
                <label>Mes</label>
                <select name="ID_Mes"  class="form-control">               
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>             
               
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="form-group">    
            <label>Año</label>
            </br>
            <input type="number" name="ID_Ano"
            min="2000" max="5000" step="1" value="2018">
        </div>
    </div>  
    </div>

 
       

            {!!Form::close()!!}
        <!--</div>--> 
         
 

   @push ('scripts')
<script>

</script>
@endpush

@endsection