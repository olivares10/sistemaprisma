<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/avatar_plusis.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">FUNCIONES</li>
            <!-- Optionally, you can add icons to the links -->
            @role('administrador')   
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>USUARIOS</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('listado_usuarios') }}">Listado Usuarios</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
            @else
           

            @endrole
            @can('areas.view')
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Areas y Puesto de Trabajo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('areas') }}">Areas</a></li>
                   <li><a href="{{ url('cargos') }}">Puesto de trabajo</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
            @else
                
            @endcan
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Actividades</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('Tipos_A') }}">Tipo Actividades</a></li>
                   <li><a href="{{ url('Actividades') }}">Actividades</a></li>
                   
                    <li><a href="#"></a></li>
                </ul>
            </li>
             <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Personal</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <!-- /<li><a href="{{ url('listado_empleados') }}">Listado Personal</a></li>-->
                    <li><a href="{{ url('empleados') }}">Listado de Personal</a></li>
                    <li><a href="{{ url('lista_negra') }}">lista negra</a></li>
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-building-o'></i> <span>Proyectos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('proyectos') }}">Proyectos</a></li>
                   <!-- /. <li><a href="{{ url('cargos') }}">Empleados en Proyectos</a></li>-->
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Asistencia</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('asistencia') }}">Asistencia</a></li>    
                   <li><a href="{{ url('llega_tarde') }}">Llegadas tarde</a></li>               
                   <!-- /. <li><a href="{{ url('cargos') }}">Empleados en Proyectos</a></li>-->
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-usd'></i> <span>Planilla</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('planilla_ciclo') }}">Planilla</a></li>
                   <!-- /.<li><a href="{{ url('planilla_ciclo') }}">Salario Mensual</a></li>
                   <li><a href="{{ url('planillas') }}">Planilla por Proyectos</a></li>
                   <li><a href="{{ url('Planilla_Empleado') }}">Planilla por Empleado</a></li>-->
                   <!-- /. <li><a href="{{ url('cargos') }}">Empleados en Proyectos</a></li>-->
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-usd'></i> <span>Liquidacion</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('Liquidacion') }}">Salario Fijo</a></li>  
                   <li><a href="{{ url('LiquidacionV') }}">Salario Variable</a></li>  
                   <!-- /. <li><a href="{{ url('cargos') }}">Empleados en Proyectos</a></li>-->
                    <li><a href="#"></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-usd'></i> <span>Aguinaldo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   <!-- /. <li><a href="{{ url('listado_areas') }}">Areas</a></li> -->
                   <li><a href="{{ url('Aguinaldo') }}">Nuevo</a></li>
                  <!--  <li><a href="{{ url('planillas') }}">Automatico</a></li>
                   /. <li><a href="{{ url('cargos') }}">Empleados en Proyectos</a></li>-->
                    <li><a href="#"></a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
