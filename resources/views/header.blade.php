<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System Landing Page</title>

    <!-- Bootstrap core CSS -->
    <link href="include/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">



    <!-- Custom styles for this template -->
    <link href="headers.css" rel="stylesheet">
</head>

<body>
    
    <!-- start of header -->
    <main>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <span class="fs-4">My Web Application</span>
                </a>

                <ul class="nav nav-pills">
                    <li class="nav-item"><a href={{ route('home') }} 
                        @class([
                            'nav-link',
                            'active' => Request::is('/')
                        ])
                        >Home</a>
                    </li>
                    <li class="nav-item"><a href={{ route('joblist') }} 
                        @class([
                            'nav-link',
                            'active' => Request::is('joblist')
                        ]) >Job List</a>
                    </li>
                </ul>
            </header>
        </div>