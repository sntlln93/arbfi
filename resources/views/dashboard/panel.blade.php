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

          <li class="bg_lb span3"> <a href="{{ url('/teams') }}"> <i class="icon-group"></i> Equipos</a> </li>
          <li class="bg_db span3"> <a href="{{ url('/institutions') }}"> <i class="icon-building"></i> Instituciones</a> </li>
          <li class="bg_lg span3"> <a href="{{ url('/players') }}"> <i class="icon-user"></i> Jugadores </a> </li>
          <li class="bg_dg span3"> <a href="{{ url('/tournaments') }}"> <i class="icon-sitemap"></i> Torneos</a> </li>
          <li class="bg_ly span3"> <a href="{{ url('/fixtures') }}"> <i class="icon-link"></i> Partidos</a> </li>

          <li class="bg_dy span3"> <a href="{{ url('/categories') }}"> <i class="icon-file"></i> Categorías</a> </li>
        </ul>
      </div>
  <!--End-Action boxes-->    

      <hr/>
        
  <!--end-main-container-part-->
@endsection
