<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">SISTEMA</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-building-o'></i> <span>Inicio</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-folder-open-o'></i> <span>Proyectos Aprobados</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Proyecto/Nuevo">Ingresar Proyecto</a></li>
                    <li><a href="/Proyecto/Filtro">Filtros de Proyectos</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-file-pdf-o'></i> <span>Actas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Acta/Nuevo">Ingresar Acta</a></li>
                    <li><a href="/Acta/Filtro">Filtros de Actas</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-edit'></i> <span>Solicitudes en Sala</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Solicitud/Nuevo">Ingresar Solicitud</a></li>
                    <li><a href="/Solicitud/Filtro">Filtros de Solicitudes</a></li>
                </ul>
            </li>
            <li class="header">GENERALES</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-tasks'></i> <span>Mantenedor Sesiones</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Mantenedor/Sesiones">Mantenedor de Sesiones</a></li>
                    <li><a href="/Mantenedor/Consejeros">Mantenedor de Consejeros</a></li>
                    <li><a href="/Mantenedor/Comisiones">Mantenedor de Comisiones</a></li>
                    <li><a href="/Mantenedor/Usuarios">Mantenedor de Usuarios</a></li>
                    <li><a href="/AcercaDe">Acerca de</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
