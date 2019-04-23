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
                            @include('website.raw_regulation')
                        </div>
                    </aside>
                </div>
            </div>
</section>

@endsection