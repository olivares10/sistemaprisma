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
    
            
            {!!Form::open (array('url'=>'/storeplanilla','method'=>'POST','autocomplete'=>'off')) !!}
           
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
    <input type="hidden" name="Periodo" value="{{$data->ID}}">	

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">    
                <label>Tipo</label>
                <select name="ID_Tipo"  class="form-control">                             
                    <option value="1">Proyecto</option>  
                    <option value="2">Personal Administrativo</option>                    
                </select>  
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div>
                <label for="NOMBRE">PROYECTO</label>              
                <select name="ID_P" id="ID_Proyecto" class="form-control selectpicker" data-live-search="true" required>
                @foreach ($proyectos as $proyecto)                
                  
                   <option value="{{$proyecto->ID_PROYECTO}}">{{$proyecto->NOMBRE_PROYECTO}}</option> 
                @endforeach
                </select>    
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