@extends('layouts.web_layout.front_design')
@section('content')

<section class="content-info">
        <div class="container">
            <div class="row paddings-mini">
                <div class="col-md-12">
                    <aside class="panel-box">
                        <div class="titles no-margin">
                            <h4><b>{{ $post->title }}</b> <small>{{ $post->created_at->diffForHumans() }}<a> por <b>{{ $post->user->username }}</b> </a> </small></h4>

                        </div>
                        <div class="info-panel">
                                
                                
                                <div style="text-align: center;" class="img-hover">
                                    <img style="width: 100%;" src="{{ asset('img/frontend_img/galery/20.jpg') }}" alt="" class="img-responsive">
                                </div>

                                <p><br/>{{ $post->body }}</p>
                        </div>
                    </aside>
                </div>
            </div>
</section>

@endsection