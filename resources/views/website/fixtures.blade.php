@extends('layouts.front_layout.front_design')

@section('content')
            <!-- Section Area - Content Central -->
            <section class="content-info">

                    <div class="container paddings-mini">
                        <div class="row">
    
                            <div class="col-lg-12">
                                <h3 class="clear-title">Partidos</h3>
                            </div>
    
                            <div class="col-lg-12">
                                <table class="table-striped table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>Local</th>
                                            <th class="text-center">VS</th>
                                            <th>Visitante</th>
                                            <th>Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{asset('img/frontend_img/clubs-logos/colombia.png')}}" alt="icon">
                                                <strong>Andino</strong><br>
                                                <small class="meta-text">Cat. 2002</small>
                                            </td>
                                            <td class="text-center">Vs</td>
                                            <td>
                                                <img src="{{asset('img/frontend_img/clubs-logos/japan.png')}}" alt="icon1">
                                                <strong>Tesorieri</strong><br>
                                                <small class="meta-text">Cat. 2002</small>
                                            </td>
                                            <td>
                                                Jun 19,  18:00<br>
                                                <small class="meta-text">Cancha</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    
                    <!-- Newsletter -->
                    <div class="section-newsletter">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <h2>Enter your e-mail and <span class="text-resalt">subscribe</span> to our newsletter.</h2>
                                        <p>Duis non lorem porta,  eros sit amet, tempor sem. Donec nunc arcu, semper a tempus et, consequat.</p>
                                    </div>
                                    <form id="newsletterForm" action="php/mailchip/newsletter-subscribe.php">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input class="form-control" placeholder="Your Name" name="name"  type="text" required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input class="form-control" placeholder="Your  Email" name="email"  type="email" required="required">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-primary" type="submit" name="subscribe" >SIGN UP</button>
                                                     </span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div id="result-newsletter"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Newsletter -->
                </section>
                <!-- End Section Area -  Content Central -->
    @endsection