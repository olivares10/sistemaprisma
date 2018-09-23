

{!! Form::open(array('url'=>'/planilla_Ciclo','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'form-bootstrap')) !!}
<div class="form-group" width="100%">

    <div class="input-group input-group-sm" width="100%">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar...."  values"{{$searchText}}">
        <!--class="input-group-btn"-->
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
    </div>

</div>

{!!Form::close()!!}
