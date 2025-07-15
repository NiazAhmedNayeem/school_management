<!DOCTYPE html>
<html lang="en">
    
    <!-- Header -->
    <head>
        @include('backend.partials.header')
    </head>

    <body class="sb-nav-fixed">


        <!-- Navbar -->
        @include('backend.partials.navbar')


        <div id="layoutSidenav">

            <!-- Sidebar -->
            @include('backend.partials.sidebar')


            
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @yield('main-content')
                    </div>
                </main>
                
                <!-- Footer -->
                @include('backend.partials.footer')

            </div>
        </div>
       {{-- Script section --}}
        @include('backend.partials.script')
        @yield('scripts')

        

    </body>
</html>
