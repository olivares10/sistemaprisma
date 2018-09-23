@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<section  id="contenido_principal">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Areas</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>            
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

			{!!Form::select('area',$areaselect,null,['ID_Area'=>'area'])!!}
			{!!Form::select('cargo',$areaselect,null,['ID_Area'=>'area'])!!}
		    </div>
</div>

</section>
<!-- <script  type="text/javascript">
	$("areaselect").select2({

	});
</script>	-->
@endsection