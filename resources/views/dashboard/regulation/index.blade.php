@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Reglamento</i></a></div>
    </div>
    
    <div class="container-fluid">

      <div class="widget-box">
          <div class="widget-content nopadding">
            @foreach($chapters as $chapter)
                <h5><a href="{{ url('/chapters/'.$chapter->id.'/edit') }}">CAPITULO {{ $chapter->name }}</a></h5>
                @foreach($chapter->articles as $article)
                    <a href="{{ url('/articles/'.$article->id.'/edit') }}"><span><b>Art. {{ $article->name }}°)</b> {{ $article->body }}<br></span></a>
                    @if($article->subsections)
                        @foreach($article->subsections as $subsection)
                        <a href="{{ url('/subsections/'.$subsection->id.'/edit') }}"><p>&emsp;&emsp;&emsp;&emsp;Inc. {{ mb_strToLower($subsection->name).') '.$subsection->body }}</p></a>
                        @endforeach
                    @endif
                @endforeach
            @endforeach
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