
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Inicio</a>
  <ul>
    
    <li class="{{ request()->is('dashboard') ? 'active' : '' }}" ><a href="{{ url('/dashboard') }}"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>
      
      
    <li class="{{ request()->is('institutions') ? 'active' : '' }}" > <a href="{{ url('institutions') }}"><i class="icon icon-hospital"></i> <span>Instituciones</span></a></li>
    <li class="{{ request()->is('categories') ? 'active' : '' }}" > <a href="{{ url('categories') }}"><i class="icon icon-folder-close"></i> <span>Categorías</span></a></li>
    <li class="{{ request()->is('players') ? 'active' : '' }}" > <a href="{{ url('players') }}"><i class="icon icon-file"></i> <span>Jugadores</span></a></li>
    <li class="{{ request()->is('tournaments') ? 'active' : '' }}" > <a href="{{ url('tournaments') }}"><i class="icon icon-file"></i> <span>Torneos</span></a></li>
    <li class="{{ request()->is('fixtures') ? 'active' : '' }}" > <a href="{{ url('fixtures') }}"><i class="icon icon-file"></i> <span>Partidos</span></a></li>
    <li class="{{ request()->is('posts') ? 'active' : '' }}" > <a href="{{ url('posts') }}"><i class="icon icon-file"></i> <span>Posts</span></a></li>
    <li class="submenu {{ request()->is('regulation') ? 'active' : '' }}"> <a href="#"><i class="icon icon-folder-close"></i> <span>Reglamento</span></a>
      <ul>
        <li><a href="{{ url('chapters/create') }}"><i class="icon icon-file"></i> <span>Nuevo capítulo</span></a></li>
        <li><a href="{{ url('articles/create') }}"><i class="icon icon-file"></i> <span>Nuevo artículo</span></a></li>
        <li><a href="{{ url('subsections/create') }}"><i class="icon icon-file"></i> <span>Nuevo inciso</span></a></li>
        <li><a href="{{ url('regulation') }}"><i class="icon icon-file"></i> <span>Ver reglamento</span></a></li>
      </ul>
    </li>
    
  </ul>
</div>
<!--sidebar-menu-->
