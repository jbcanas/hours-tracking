<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>ILWU Dispatch</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="author" />

        <link rel="stylesheet" href="{!! mix('/assets/css/vendor.css') !!}">
        <link rel="stylesheet" href="{!! mix('/assets/css/app.css') !!}">
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]); !!}
        </script>
    </head>
    <!-- END HEAD -->

    <body>
    	
    	<div id="app"></div>

        <script>
            window.companyName = '{!! env('COMPANY') !!}';
        </script>
        <script src="{!! mix('/assets/js/app.js') !!}"></script>
    </body>

</html>
