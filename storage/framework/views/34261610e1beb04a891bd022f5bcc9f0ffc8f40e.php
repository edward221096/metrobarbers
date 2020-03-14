    <!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

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

    .form-header{
        font-size: 17px;
        padding-top: 20px;
        margin: 10px;
    }

    .info{
        font-size: 15px;

    }
    .form-row{
        margin: 25px;
    }

</style>
    <div class="main_content">
        <div class="info">
            <div class="form-header">Edit Employee Form</div>
            <form method="POST" action="<?php echo e(action('UserController@update', $id)); ?>">
                <!-- FULL NAME TEXTBOX -->
                <?php echo e(csrf_field()); ?>

            <input type="hidden" name="_method" value="PATCH"/>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" placeholder="Full Name"  required autocomplete="name"
                               value="<?php echo e($users->name); ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email">E-mail Address</label>
                        <input type="text" class="form-control form-control-sm" name="email" placeholder="E-mail Address" required autocomplete="email"
                               value="<?php echo e($users->email); ?>">
                    </div>
                    <!-- ADDRESS TEXTBOX -->
                    <div class="form-group col-md-12">
                        <label for="address">Address</label>
                        <input type="text" class="form-control form-control-sm" name="address" placeholder="Address" required autocomplete="address"
                               value="<?php echo e($users->address); ?>">
                    </div>

                    <!-- PHONENUMBER TEXTBOX -->
                    <div class="form-group col-md-12">
                        <label for="phonenumber">Phone Number</label>
                        <input type="number" class="form-control form-control-sm" name="phonenumber" placeholder="Phone Number" required autocomplete="phonenumber"
                               value="<?php echo e($users->phonenumber); ?>">
                    </div>
                    <!-- POSITION COMBOBOX-->
                    <div class="form-group col-md-12">
                        <label for="role">Role</label>
                        <select name="role" class="form-control form-control-sm" value="<?php echo e($users->role); ?>">
                            <option selected>Barber</option>
                            <option>Receptionist</option>
                            <option>User</option>
                        </select>
                    </div>
                    <!-- ADD BUTTON-->
                    <input class="btn btn-primary btn-sm" type="submit" value="Submit">

                    <!-- CANCEL BUTTON-->
                    <a href="<?php echo e(__('/employees')); ?>" class="btn btn-secondary btn-sm" style="float: right;" type="submit">Cancel</a>
                </div>
                </div>
            </form>
<?php /**PATH C:\laravel\Metrobarbers\resources\views/editemployees.blade.php ENDPATH**/ ?>