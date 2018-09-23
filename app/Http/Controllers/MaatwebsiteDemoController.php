<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\area;
use DB;
use Excel;

class MaatwebsiteDemoController extends Controller

{

	public function importExport()

	{

		return view('importExport');

	}

	public function downloadExcel($id)

	{     
		
		 $type='xlsx' ;
		return Excel::create('Planilla', function($excel)  use ($id) {

			$excel->sheet('Datos', function($sheet) use ($id)

	        {
				//header
			$sheet->mergeCells('A1:E1');
			$sheet->row(1,['Prueba Luis']);
			$sheet->row(2);
			$sheet->row(3,['Codigo','Cargo','Nombre','Dias Trabajados','Salario O','Horas Ext','Salario Ext','Total Devengado','Inss','Total Neto','IR','Viaticos','Anticipos','Deducciones','Ret Sindical','Total']);
        

		$planilla=DB::table('planilla_final') 
		->join('empleado as e', 'planilla_final.ID_EMPLEADO','=','e.ID_EMPLEADO') 
		->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')     
		->select('e.Cod_Empleado','Dias_trabajados','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'Precio_Del_Dia','Salario_O','Septimo_D','Horas_Extras','Valor_Horas_E',
		'Salario_Extraordinario','Total_Devengado','Inss','Total_Neto','IR','Viaticos','Anticipos','Deducciones','Ret_Sindical','Total')  
		->where('Periodo','=',$id)
		->paginate(1000);
        //$data = vw_equipo_produccion::get()->toArray(); 
		//$data=[];	

        foreach ($planilla as $vw){
            $row =[];
            $row[0]=$vw->Cod_Empleado;
            $row[1]=$vw->Nombre_Cargo;
            $row[2]=$vw->Nombre_Empleado;
            $row[3]=$vw->Dias_trabajados;
			$row[4]=$vw->Salario_O;
			$row[5]=$vw->Horas_Extras;
			$row[6]=$vw->Salario_Extraordinario;
			$row[7]=$vw->Total_Devengado;
			$row[8]=$vw->Inss;
			$row[9]=$vw->Total_Neto;
			$row[10]=$vw->IR;
			$row[11]=$vw->Viaticos;
			$row[12]=$vw->Anticipos;
			$row[13]=$vw->Deducciones;
			$row[14]=$vw->Ret_Sindical;
			$row[15]=$vw->Total;
			$sheet->appendRow($row);
            //$data[]=$row;

        }

	        });

		})->download($type);

	}
	public function downloadExcelA($id)

	{     
		
		 $type='xlsx' ;
		return Excel::create('Aguinaldo', function($excel)  use ($id) {

			$excel->sheet('Datos', function($sheet) use ($id)

	        {
				//header
			$sheet->mergeCells('A1:E1');
			$sheet->row(1,['Aguinaldo']);
			$sheet->row(2);
			$sheet->row(3,['Codigo','Cargo','Nombre','Tipo Fecha Inicio','Fecha Corte O','Salario Junio','Salario Julio','Salario Agosto','Salario Septiembre','Salario Octubre','Salario Noviembre','Dias a Favor','Monto A pagar']);
        

            $aguinaldo=DB::table('aguinaldo_detalle') 
            ->join('empleado as e', 'aguinaldo_detalle.ID_EMPLEADO','=','e.ID_EMPLEADO') 
            ->join('cargo as c', 'e.ID_CARGO','=','c.ID_Cargo')     
            ->join('aguinaldo as a', 'aguinaldo_detalle.ID_Aguinaldo','=','a.ID')  
            ->select('e.Cod_Empleado','Tipo','e.ID_EMPLEADO','c.Nombre_Cargo',DB::raw('CONCAT(e.PRIMER_NOMBRE," ",e.SEGUNDO_NOMBRE," ",e.PRIMER_APELLIDO," ",e.SEGUNDO_APELLIDO) as Nombre_Empleado'),'Fecha_Inicio','a.Fecha_corte','Salario_Junio','Salario_Julio','Salario_Agosto','Salario_Septiembre',
            'Salario_Octubre','Salario_Noviembre','Dias_a_favor','Monto_pagar')  
            ->where('aguinaldo_detalle.ID_Aguinaldo','=',$id) 
            ->paginate(1000);
        //$data = vw_equipo_produccion::get()->toArray(); 
		//$data=[];	

        foreach ($aguinaldo as $vw){
            $row =[];
            $row[0]=$vw->Cod_Empleado;
            $row[1]=$vw->Nombre_Cargo;
            $row[2]=$vw->Nombre_Empleado;
            $row[3]=$vw->Tipo;
			$row[4]=$vw->Fecha_Inicio;
			$row[5]=$vw->Fecha_corte;
			$row[6]=$vw->Salario_Junio;
			$row[7]=$vw->Salario_Julio;
			$row[8]=$vw->Salario_Agosto;
			$row[9]=$vw->Salario_Septiembre;
			$row[10]=$vw->Salario_Octubre;
			$row[11]=$vw->Salario_Noviembre;
			$row[12]=$vw->Dias_a_favor;
			$row[13]=$vw->Monto_pagar;
			$sheet->appendRow($row);
            //$data[]=$row;

        }

	        });

		})->download($type);

	}

	public function importExcel()

	{

		if(Input::hasFile('import_file')){

			$path = Input::file('import_file')->getRealPath();

			$data = Excel::load($path, function($reader) {

			})->get();

			if(!empty($data) && $data->count()){

				foreach ($data as $key => $value) {

					$insert[] = ['title' => $value->title, 'description' => $value->description];

				}

				if(!empty($insert)){

					DB::table('items')->insert($insert);

					dd('Insert Record successfully.');

				}

			}

		}

		return back();

	}

}