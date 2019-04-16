@extends('layouts.dash_layout.dashboard_design')

@section('content')
  <!--main-container-part-->
  <div id="content">
  <!--breadcrumbs-->
    <div id="content-header">
      <div id="breadcrumb">
        <a href="#" class="current"><i class="icon-home"></i> Inicio</a>
      
    </div>  
  <!--End-breadcrumbs-->
 
  <!--Action boxes-->
    <div class="container-fluid">
      <div class="quick-actions_homepage">
        <ul class="quick-actions">

          <li class="bg_lb span3"> <a href="{{ url('/secretarias') }}"> <i class="icon-hospital"></i> Secretarías</a> </li>
          <li class="bg_db span3"> <a href="{{ url('/categorias') }}"> <i class="icon-reorder"></i> Categorías</a> </li>
          <li class="bg_lg span3"> <a href="{{ url('/oficinas') }}"> <i class="icon-th-list"></i> Oficinas </a> </li>
          <li class="bg_dg span3"> <a href="{{ url('/funciones') }}"> <i class="icon-cogs"></i> Funciones</a> </li>
          <li class="bg_ly span3"> <a href="{{ url('/afectaciones') }}"> <i class="icon-folder-close"></i> Afectaciones</a> </li>

          <li class="bg_dy span3"> <a href="{{ url('/plantas') }}"> <i class="icon-folder-close"></i> Plantas</a> </li>
          <li class="bg_lo span3"> <a href="{{ url('/situaciones') }}"> <i class="icon-folder-close"></i> Situaciones</a> </li>
          <li class="bg_ls span3"> <a href="{{ url('/laborales') }}"> <i class="icon-briefcase"></i> Datos Laborales</a> 
          <li class="bg_lr span3"> <a href="{{ url('/titulos') }}"> <i class="icon-folder-close"></i> Títulos</a> </li>
          <li class="bg_lv span3"> <a href="{{ url('/horarios') }}"> <i class="icon-list-alt"></i> Horarios</a> </li>

          <li class="bg_lh span3"> <a href="{{ url('/turnos') }}"> <i class="icon-time"></i> Turnos</a> </li>          
          <li class="bg_lo span3"> <a href="{{ url('/asistencias') }}"> <i class="icon-check"></i> Asistencia</a> </li>
          <li class="bg_lg span3"> <a href="{{ url('/contraturnos') }}"> <i class="icon-time"></i> Contraturnos</a> </li>
          <li class="bg_ls span3"> <a href="{{ url('/personal') }}"> <i class="icon-user"></i> Datos Personales</a> </li>         
          <li class="bg_dy span3"> <a href="{{ url('/estadisticas') }}"> <i class="icon-signal"></i> Estadísticas</a> </li>
        </ul>
      </div>
  <!--End-Action boxes-->    

      <hr/>
        
  <!--end-main-container-part-->
@endsection
