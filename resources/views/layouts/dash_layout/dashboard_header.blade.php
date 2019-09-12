<!--Header-part-->
<div id="header">
    <img src="{{ asset('/img/frontend_img/logo_header.png') }}" alt="">
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
	<div id="user-nav" class="navbar navbar-inverse">
  		<ul class="navbar">
    		<li class="">
    			<a title=""><i class="icon icon-user"></i>
    				<span class="text">{{ Auth::user()->username }}</span>
    			</a>
    		</li>
    		<li class="">
                <a title="" href="{{ url('/logout') }}"><i class="icon icon-off"></i>
                    <span class="text"> Cerrar sesión</span>
                </a>
            </li>
            <li class="">
                <a title="" href="{{ url('/change') }}"><i class="icon icon-key"></i>
                    <span class="text"> Cambiar contraseña</span>
                </a>
            </li>
    	</ul>
    </div>
<!--close-top-Header-menu-->