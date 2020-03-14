<!DOCTYPE html>
<html>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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
        color: #717171;
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
</style>

<body>

<!-- Sidebar -->
<div class="wrapper">
    <div class="sidebar">
        <h2>Navigation</h2>
        <ul>
            <li><a href="about"><i class="fas fa-home"></i>About</a></li>
            <li><a href="userprofile"><i class="fas fa-user"></i>User Profile</a></li>
            <li><a href="#"><i class="fas fa-users"></i>Manage Customers</a></li>
            <li><a href="#"><i class="far fa-credit-card"></i> Payment Transactions</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
        </ul>
    </div>
</body>
</html>
<?php /**PATH C:\laravel\Metrobarbers\resources\views/layouts/home.blade.php ENDPATH**/ ?>