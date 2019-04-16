<!DOCTYPE html>
<html lang="es">
<head>
  
<title>Panel de control</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- MORRIS.JS [EL ORDEN IMPORTA!] -->
<link rel="stylesheet" href="{{ asset('css/backend_css/morris.css') }}" />
<script src="{{ asset('js/backend_js/jquery.js') }}"></script>
<script src="{{ asset('js/backend_js/raphael-min.js') }}"></script> 
<script src="{{ asset('js/backend_js/morris.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-media.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('fonts/backend_fonts/css/font-awesome.css') }}"  />
<link rel="stylesheet" href="{{ asset('css/backend_css/jquery.gritter.css') }}" />
<link rel='stylesheet' href="{{ asset('css/backend_css/fonts.google.css') }}" type='text/css'>

<style type="text/css">
a.disabled {
  pointer-events: none;
  cursor: default;
}
</style>

<!--RESPONSIVE TABLES-->
<style type="text/css">
@media (max-width:575.98px){
  .table-responsive-sm{
    display:block;
    width:100%;
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    -ms-overflow-style:-ms-autohiding-scrollbar
  }
  .table-responsive-sm>.table-bordered{
    border:0
  }
}
@media (max-width:767.98px){
  .table-responsive-md{
    display:block;
    width:100%;
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    -ms-overflow-style:-ms-autohiding-scrollbar
  }
  .table-responsive-md>.table-bordered{
    border:0
  }
}
@media (max-width:991.98px){
  .table-responsive-lg{
    display:block;
    width:100%;
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    -ms-overflow-style:-ms-autohiding-scrollbar
  }
  .table-responsive-lg>.table-bordered{
    border:0
  }
}
@media (max-width:1199.98px){
  .table-responsive-xl{
    display:block;
    width:100%;
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
    -ms-overflow-style:-ms-autohiding-scrollbar
  }
  .table-responsive-xl>.table-bordered{
    border:0
  }
}

.table-responsive{
  display:block;
  width:100%;
  overflow-x:auto;
  -webkit-overflow-scrolling:touch;
  -ms-overflow-style:-ms-autohiding-scrollbar
}
.table-responsive>.table-bordered{
  border:0
}</style>

<!--END RESPONSIVE TABLES-->

</head>
<body>

<!--Header-->
  @include('layouts.dash_layout.dashboard_header')
<!--close-header-->
  

<!--sidebar-menu-->
  @include('layouts.dash_layout.dashboard_sidebar')
<!--sidebar-menu-->


<!--main-container-part-->
    
      @yield('content')
    
<!--end-main-container-part-->


<!--Footer-part-->
  @include('layouts.dash_layout.dashboard_footer')
  
<!--end-Footer-part-->


<script src="{{ asset('js/backend_js/excanvas.min.js') }}"'></script> 
<script src="{{ asset('js/backend_js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.flot.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.flot.resize.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.peity.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/fullcalendar.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.dashboard.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.gritter.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.interface.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.chat.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.wizard.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/backend_js/select2.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script> 
<script src="{{ asset('js/backend_js/bootstrap-datepicker.js') }}"></script> 
<script src="{{ asset('js/backend_js/masked.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.toggle.buttons.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.form_common.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.quicksearch.js') }}"></script> 

 <!--QuickSearch-->


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>

<script type="text/javascript">
$(document).ready(function(){

var quantitiy=0;
   $('.quantity-right-plus').click(function(e){
        
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
            
            $('#quantity').val(quantity + 1);

          
            // Increment
        
    });

     $('.quantity-left-minus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity').val());
        
        // If is not undefined
      
            // Increment
            if(quantity>0){
            $('#quantity').val(quantity - 1);
            }
    });
    
});
</script>


</body>
</html>
