@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/fixtures') }}" class="tip-bottom">Partidos</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Confirmar resultado</i></a></div>
    </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5> Cat. {{ $match->visiting->category->name }}: {{ $match->local->club->name }} vs {{ $match->visiting->club->name }}</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/fixtures/'.$match->id }}">
              {{ csrf_field() }}                                                           
              {{ method_field('PUT') }}
              <table class="table table-bordered data-table table-responsive-lg">
                  <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Apellido y Nombre</th>
                        <th>DNI</th>
                        <th>Goles</th>
                        <th>Amarilla</th>
                        <th>Verde</th>
                        <th>Roja</th>                                                
                    </tr>
                  </thead>
                  <tbody>
                    @php($flag = true)
                    @foreach($match->local->players as $player)
                      <tr>
                        @if($flag)
                          <th style="width: 15%" rowspan="{{ $match->local->players->count()}}"> {{ $match->local->club->name }}</th>
                          @php($flag = false)
                        @endif
                          <th style="width: 20%"> {{ $player->last_name }} {{ $player->first_name }}</th>
                          <th style="width: 10%"> {{ $player->dni }}</th>
                          <th style="width: 30%"><input class="span2" name="local_score[{{$player->id}}]" type="number" value="0"></th>
                          <th style="width: 5%"><input type="checkbox" name="local_yellow[{{$player->id}}]"/></th>
                          <th style="width: 5%"><input type="checkbox"  name="local_green[{{$player->id}}]"/></th>
                          <th style="width: 5%"><input type="checkbox" name="local_red[{{$player->id}}]"/></th>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    @php($flag = true)
                    @foreach($match->visiting->players as $player)
                      <tr>
                          @if($flag)
                            <th style="width: 15%" rowspan="{{ $match->visiting->players->count()}}"> {{ $match->visiting->club->name }}</th>
                            @php($flag = false)
                          @endif
                          <th style="width: 20%"> {{ $player->last_name }} {{ $player->first_name }}</th>
                          <th style="width: 10%"> {{ $player->dni }}</th>
                          <th style="width: 30%"><input class="span2" name="visiting_score[{{$player->id}}]" type="number" value="0"></th>
                          <th style="width: 5%"><input type="checkbox" name="visiting_yellow[{{$player->id}}]"/></th>
                          <th style="width: 5%"><input type="checkbox"  name="visiting_green[{{$player->id}}]"/></th>
                          <th style="width: 5%"><input type="checkbox" name="visiting_red[{{$player->id}}]"/></th>
                      </tr>
                    @endforeach                  
                  </tfoot>
                </table>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>

          </div> <!--widget-content nopadding-->
        </div> <!--widget-box-->
        @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
      </div> <!--span6-->
    </div><!--row-fluid-->
  </div> <!--container-fluid-->
</div> <!--content-->


@endsection