@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')

   <div class='row'>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Empleado Aliquidar: {{$liquidacionV->Empleado}}</h3>

            <div>
                <label for="Antigüedad">Antigüedad</label>
                <input type="text" name="Antiguedad" class="form-control" value="{{$liquidacionV->Antiguedad}}">
            </div>
            <div>
                <label for="DíasIndemnización">Días Indemnización</label>
                <input type="text" name="Descripcion" class="form-control" value="{{$liquidacionV->Dias_Indemnizacion}}">
            </div>
            <h4>Ingresos</h4>
            <div>
                <label for="Indemnizacion">Indemnización</label>
                <input type="text" name="Indemnizacion" class="form-control" value="{{$liquidacionV->Indemnizacion}}">
            </div>
            <div>
                <label for="Aguinaldo">Aguinaldo</label>
                <input type="text" name="Aguinaldo" class="form-control" value="{{$liquidacionV->Aguinaldo}}" >
            </div>
            <div>
                <label for="Vacaciones">Vacaciones</label>
                <input type="text" name="Vacaciones" class="form-control" value="{{$liquidacionV->Vacaciones}}">
            </div>
            <div>
                <label for="Salario_Proporcional">Salario Proporcional</label>
                <input type="text" name="Salario_Proporcional" class="form-control" value="{{$liquidacionV->Salario_Proporcional}}">
            </div>
            <div>
                <label for="Ingresos_Brutos">Ingresos Brutos</label>
                <input type="text" name="Ingresos_Brutos" class="form-control" value="{{$liquidacionV->Ingresos_Brutos}}">
            </div>
            <div>
                <label for="INSS_Vacaciones">INSS Vacaciones</label>
                <input type="text" name="INSS_Vacaciones" class="form-control" value="{{$liquidacionV->INSS_Vacaciones}}">
            </div>
            <div>
                <label for="INSS_Salario">INSS Salario</label>
                <input type="text" name="INSS_Salario" class="form-control" value="{{$liquidacionV->INSS_Salario}}">
            </div>
            <div>
                <label for="INSS_Total">INSS Total</label>
                <input type="text" name="INSS_Total" class="form-control" value="{{$liquidacionV->INSS_Total}}">
            </div>
            <div>
                <label for="IR_Salario_Proporcional">IR Salario Proporcional</label>
                <input type="text" name="IR_Salario_Proporcional" class="form-control" value="{{$liquidacionV->IR_Salario_Proporcional}}">
            </div>
            <div>
                <label for="IR_Vacaciones">IR Vacaciones</label>
                <input type="text" name="IR_Vacaciones" class="form-control" value="{{$liquidacionV->IR_Vacaciones}}">
            </div>
            <div>
                <label for="IR_Total">IR Total</label>
                <input type="text" name="IR_Total" class="form-control" value="{{$liquidacionV->IR_Total}}">
            </div>
            <div>
            <h4>Neto a Recibir</h4>
                <input type="text" name="Neto_Recibir" class="form-control" value="{{$liquidacionV->Neto_Recibir}}">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" >Guardar</button>
              
                <button class="btn btn-danger" type="reset" >cancelar</button>
                
            </div>

        </div>
         
   </div> 

@endsection