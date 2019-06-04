@extends('layouts.web_layout.front_design')
@section('content')

<section class="content-info">
        <div class="container">
            <div class="row paddings-mini">
                <div class="col-md-12">
                    <aside class="panel-box">
                        <div class="titles no-margin">
                            <h4>Reglamento General</h4>
                        </div>
                        <div class="info-panel">
                            @foreach($chapters as $chapter)
                                <h5><a>CAPITULO {{ $chapter->name }}</a></h5>
                                @foreach($chapter->articles as $article)
                                    <span><b>Art. {{ $article->name }})</b> {{ $article->body }}<br></span>
                                    @if($article->subsections)
                                        @foreach($article->subsections as $subsection)
                                        <p>&emsp;&emsp;&emsp;&emsp;Inc. {{ mb_strToLower($subsection->name).') '.$subsection->body }}</p>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </aside>
                </div>
            </div>
</section>

@endsection