<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-70RE8MK291%22%3E"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'G-70RE8MK291');
        </script>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Portreto</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}"/>
    </head>
    <body>
        <div id="app">
            <navbar></navbar> 
            <transition appear enter-active-class="fade-in-bottom" leave-active-class="fade-out" mode="out-in">
              <router-view>
                <index-page></index-page>
              </router-view>
            </transition>    
            <default-footer></default-footer>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
