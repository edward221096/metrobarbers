<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="icon" href="<?php echo asset('images/metrobarberslogo.jpg'); ?>"/>
    <title>Metrobarbers</title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('/css/bootstrap.min.css')); ?>" rel="stylesheet">

<!-- CSS Styles for admin panel page -->
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
        font-family: 'Open Sans', sans-serif;
    }

    body{
        background-color: #1b1e20;
    }

    .wrapper{
        display: flex;
        position: relative;
    }

    .wrapper .sidebar{
        width: 215px;
        height: 100%;
        background: #3A3F44;
        padding: 30px 0px;
        position: fixed;
    }

    .wrapper .sidebar h2{
        color: #fff;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 30px;
    }

    .wrapper .sidebar ul li{
        padding: 15px;
        border-bottom: 1px solid #bdb8d7;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        border-top: 1px solid rgba(255,255,255,0.05);
    }

    .wrapper .sidebar ul li a{
        color: white;
        display: block;
    }

    .wrapper .sidebar ul li a .fas{
        width: 25px;
    }

    .wrapper .sidebar ul li:hover{
        background-color: #594f8d;
    }

    .wrapper .sidebar ul li:hover a{
        color: #fff;
    }

    .wrapper .main_content{
        width: 100%;
        margin-left: 200px;
    }

    .wrapper .main_content .header{
        padding: 20px;
        background: #3A3F44;
        color: white;
        border-bottom: 1px solid #3A3F44;
    }

    .wrapper .main_content .info{
        margin: 20px;
        color: white;
        line-height: 25px;
    }

    .wrapper .main_content .info div{
        margin-bottom: 20px;
    }

    @media (max-height: 500px){
        .social_media{
            display: none !important;
        }
    }

    .nav-link{
        color: white;
    }

    .dropdown-item{
        color: white;
    }
</style>
<body>

<!-- Sidebar -->
<div class="wrapper">
    <div class="sidebar">
        <h2>Navigation</h2>
        <ul>
            <?php if(Auth::User()->role == 'User'): ?>
                <li><a href="home"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="mysessions"><i class="far fa-credit-card"></i>  My Sessions</a></li>
            <?php else: ?>
                <li><a href="home"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="charts"><i class="far fa-id-card"></i>  Charts</a></li>
                <li><a href="employees"><i class="fas fa-user"></i>Manage Employees</a></li>
                <li><a href="employeestimeinout"><i class="fas fa-business-time"></i>Manage Employees Timelogs</a></li>
                <li><a href="customers"><i class="fas fa-users"></i>Manage Customers</a></li>
                <li><a href="services"><i class="far fa-handshake"></i> Manage Services</a></li>
                <li><a href="stocks"><i class="fas fa-archive"></i>Manage Item Stocks</a></li>
                <li><a href="sessions"><i class="far fa-credit-card"></i>  Manage Sessions</a></li>
            <?php endif; ?>

            <!-- For the Logout and Name -->
            <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                </li>
                <?php if(Route::has('register')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                    </li>
                <?php endif; ?>
            <?php else: ?>

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>

                <?php echo $__env->yieldContent('home'); ?>
                <?php echo $__env->yieldContent('charts'); ?>
                <?php echo $__env->yieldContent('customers'); ?>
                <?php echo $__env->yieldContent('sessions'); ?>
                <?php echo $__env->yieldContent('employees'); ?>
                <?php echo $__env->yieldContent('employeestimeinout'); ?>
                <?php echo $__env->yieldContent('services'); ?>
                <?php echo $__env->yieldContent('stocks'); ?>
                <?php echo $__env->yieldContent('memberships'); ?>
                <?php echo $__env->yieldContent('mysessions'); ?>
</div>
</body>
</html>

<?php /**PATH C:\laravel\Metrobarbers\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>