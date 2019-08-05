<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}
                    </a>
                </div>
            </div>
    @endif

    <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">DOCUMENTACIÓN</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-building-o'></i> <span>Inicio</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-users'></i> <span>Sesiones</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if( Auth::user()->level == 1 )
                        <li><a href="/Acta/Nuevo">Ingresar Acta Sesion</a></li>
                    @endif
                    <li><a href="/Acta/Filtro">Filtros de Actas Sesión</a></li>
                </ul>

            <li class="treeview">
                <a href="#"><i class='fa fa-book'></i> <span>Documentos</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Acta/Filtro">Por Comisión</a></li>
                    <li><a href="/Acta/Filtro">Por Fecha</a></li>
                </ul>
            </li>
            @if( Auth::user()->level == 1 )
                <li class="treeview">
                    <a href="#"><i class='fa fa-user'></i> <span>Comisiones</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/InformesCom/Nuevo">Ingresar Informe Comisión</a></li>
                        <li><a href="/InformesCom/Filtro">Filtros Informe Comisión</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-user'></i> <span>Subcomisiones</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="/InformeSComision/Nuevo">Ingresar Informe SubComisión</a></li>
                        <li><a href="/InformeSComision/Filtro">Filtros Informe SubComisión</a></li>
                    </ul>
                </li>
            @endif
            @if( Auth::user()->level == 1 )
                <li class="header">SISTEMA</li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-folder-open-o'></i> <span>Proyectos Aprobados</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">

                        <li><a href="/Proyecto/Nuevo">Ingresar Proyecto</a></li>

                        <li><a href="/Proyecto/Filtro">Filtros de Proyectos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class='fa fa-edit'></i> <span>Solicitudes en Sala</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">

                        <li><a href="/Solicitud/Nuevo">Ingresar Solicitud</a></li>

                        <li><a href="/Solicitud/Filtro">Filtros de Solicitudes</a></li>
                    </ul>
                </li>
            @endif
            <li class="header">CORE</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-calendar'></i> <span>Invitaciones</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Agenda/Ver">Ver Invitaciones</a></li>
                    @if( Auth::user()->level == 1 )
                        <li><a href="/Agenda/Nuevo">Administrar Invitaciones</a></li>
                    @endif
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-file-photo-o'></i> <span>COREs</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="/Galeria/Ver">Galería Fotográfica</a></li>
                </ul>
            </li>
            <li class="header">GENERALES</li>
            <li class="treeview">
                <a href="#"><i class='fa fa-tasks'></i> <span>Administración</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if( Auth::user()->level == 1 )
                        <li><a href="/Mantenedor/Areas">Mantenedor de Áreas</a></li>
                        <li><a href="/Mantenedor/Comisiones">Mantenedor de Comisiones</a></li>
                        <li><a href="/Mantenedor/Consejeros">Mantenedor de Consejeros</a></li>
                        <li><a href="/Mantenedor/Usuarios">Mantenedor de Usuarios</a></li>
                    @endif
                    <li><a href="/AcercaDe">Acerca de</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
