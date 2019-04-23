@extends('layouts.web_layout.front_design')
@section('content')
<section class="content-info">

    <!-- Nav Filters -->
    
    <!-- End Nav Filters -->

    <div class="container padding-top">
        <div class="row portfolioContainer">

                @for($i=1; $i<=19; $i++)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="item-team">
                            <div class="head-team">
                                <img src="{{ asset('img/frontend_img/galery/'. $i .'.jpg') }}" alt="location-team">
                            </div>
                        </div>
                    </div>
                @endfor
        </div>
    </div>
</section>
@endsection