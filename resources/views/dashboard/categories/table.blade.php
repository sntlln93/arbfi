@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Categorías</i></a></div>
    </div>
    
    <div class="container-fluid">
      <div class="pull-right">
        <div class="controls">
          <br>
          <div class="input-append">
              <input id="filtrar" name="search" value="" type="text" placeholder="Buscar" class="span3">
              <span class="add-on"><i class="icon-search"></i></span>
          </div>
          <div class="input-append">
              
          </div>
          <div class="input-append">
              <span><a class="btn btn-success" href="{{ '/categories/create' }}"><i class="icon-plus"></i></a></span>
          </div>
        </div>
      </div>

      <div class="widget-box">
          <div class="widget-content nopadding">
              
            <table class="table table-bordered data-table"><!--table-responsive-lg-->
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th><i class="icon-check"></i></th>

                    <th><i class="icon-pencil"></i></th>
                    <th><i class="icon-trash"></i></th>
                </tr>
              </thead>
              <tbody>
                @foreach($categories as $category)
                  <tr>
                    <th> {{ $category->id }} </th>
                    <th> {{ $category->name }} </th>
                    <th> 
                      
                        @if(!$category->enabled)
                          <a href="{{ url('/categories/'.$category->id.'/enable/') }}" class="btn btn-mini btn-warning">
                            Habilitar <i class="icon-check-empty"></i>
                          </a>
                        @else
                          <a href="{{ url('/categories/'.$category->id.'/enable/') }}" class="btn btn-mini btn-info">
                            Deshabilitar <i class="icon-check"></i>
                          </a>
                        @endif
                      
                    </th>
                    
                    <th>
                      <a href="{{ url('/categories/'.$category->id.'/edit') }}" class="btn btn-mini btn-warning"><i class="icon-pencil"></i></a>
                    </th>
                    <th> 
                      <form class="form-group" action="{{ '/categories/'.$category->id }}" method="post">
                        {{ @csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-mini btn-danger"><i class="icon-trash"></i></button> 
                      </form>
                    </th>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>

<script>
    $(function () {
    $('input#filtrar').quicksearch('table tbody tr');               
    });
</script>

@endsection