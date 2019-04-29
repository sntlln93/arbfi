@extends('layouts.web_layout.front_design')
@section('content')

<section class="content-info">
        <div class="container">
            <div class="row paddings-mini">
                <div class="col-md-12">
                    <aside class="panel-box">
                        <div class="titles no-margin">
                            <h4>{{ $post->title }} </h4>

                        </div>
                        <div class="info-panel">
                                <a>Por <b>{{ $post->user->username }}</b> </a><small>{{ $post->created_at->diffForHumans() }} </small>
                                
                                <div class="img-hover">
                                    <img src="{{ $post->path_file }}" alt="" class="img-responsive">
                                </div>

                                <p><br/>{{ $post->body }}</p>
                        </div>
                    </aside>
                </div>
            </div>
</section>

@endsection