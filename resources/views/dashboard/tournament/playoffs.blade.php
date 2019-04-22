@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Inicio</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/tournaments') }}" class="tip-bottom">Torneos</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Nuevo Torneo por llaves</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>{{ $tournament->name }} (
                        @if($tournament->type->type == "AAA") Todos contra Todos
                        @elseif($tournament->type->type == "GF") Fase de Grupos
                        @elseif($tournament->type->type == "PVP") Llaves
                        @endif | 
                        @if($tournament->type->round_trip) Ida y vuelta
                        @else Partido único
                        @endif
            )</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/tournaments/playoffs/'.$tournament->id }}">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              @php
                if($teams->count()%2 == 0) $limit = $teams->count()/2;
                else $limit = ($teams->count() - 1) / 2;
              @endphp
              
              <div class="control-group">
                <label class="control-label">Categorías</label>
                <div class="controls">
                  @for($i=0; $i< sizeof($categories); $i++)
                    <input name="names[]" type="text" disabled="true" class="span1" value="{{ $categories[$i][1] }}"/>  
                    <input name="categories[]" type="hidden" value="{{ $categories[$i][0] }}"/>  
                  @endfor
                </div>
              </div>
                    
                
              <div class="control-group">
                @for($index = 0; $index < $limit; $index++)
                <label class="control-label">{{$index+1}}° Llave</label>
                <div id="uno" class="controls">
                      <select class="sel span5" name="teams[]">
                        <option></option>
                        @for($i = 0; $i < $teams->count(); $i++)
                            <option value="{{ $teams[$i]->id }}">{{ $teams[$i]->name }}</option>
                        @endfor
                      </select>
                      VS
                      <select class="sel span5" name="teams[]">
                          <option></option>
                          @for($j = 0; $j < $teams->count(); $j++)
                              <option value="{{ $teams[$j]->id }}">{{ $teams[$j]->name }}</option>
                          @endfor
                      </select>
                </div>
                @endfor
              </div>
              
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

<script>
  $(".sel").change(function(){cambiar();});

  function cambiar(){
    var array = [];
    $(".sel :selected").each(function(){
      array[$(this).val()]=(parseInt($(this).val()));
    });
    for(i=0;i<array.length;i++){
    if(array[i]!=undefined){
        $(".sel option[value=" + array[i] + "]").hide();
      }
      if(array[i]==undefined){
        $(".sel option[value=" + i + "]").show();
      }
    }
  }
</script>

@endsection