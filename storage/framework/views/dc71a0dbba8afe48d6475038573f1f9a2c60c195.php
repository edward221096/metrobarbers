<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<style>
        .form-header{
            font-size: 17px;
        }

        .info{
            font-size: 15px;

        }
        .form-row{
            margin: 0px;
        }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<?php $__env->startSection('employees'); ?>
    <div class="main_content">
        <div class="header">Manage Employees</div>
        <div class="info">
            <div class="form-header">Employee Form</div>

            <!-- Add Employee Modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addemployeemodal">
                Add
            </button>


        <p></p>

            <!-- SHOW DATA IN A TABLE-->
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>E-mail</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($row->id); ?></td>
                            <td><?php echo e($row->name); ?></td>
                            <td><?php echo e($row->username); ?></td>
                            <td><?php echo e($row->role); ?></td>
                            <td><?php echo e($row->email); ?></td>
                            <td><?php echo e($row->address); ?></td>
                            <td><?php echo e($row->phonenumber); ?></td>
                            <td>
                                <form action="employees/<?php echo e($row->id); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field("DELETE"); ?>
                                        <!-- EDIT FUNCTIONS TYPE BUTTON -->
                                            <a href="#" class="btn btn-secondary btn-sm"
                                               data-myempid="<?php echo e($row->id); ?>"
                                               data-myfullname="<?php echo e($row->name); ?>"
                                               data-myemailaddress="<?php echo e($row->email); ?>"
                                               data-myusername="<?php echo e($row->username); ?>"
                                               data-myrole="<?php echo e($row->role); ?>"
                                               data-myaddress="<?php echo e($row->address); ?>"
                                               data-myphonenumber="<?php echo e($row->phonenumber); ?>"
                                               data-toggle="modal" data-target="#editemployee">Edit</a>
                                    <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                                    </form>
                            </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
















                </table>
    <?php echo e($users->links()); ?>

    </div>

    </div>

    <!-- EDIT Employee Modal -->
    <div class="modal fade" id="editemployee" tabindex="-1" role="dialog" aria-labelledby="editemployeelabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editemployee">Edit Employee Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('employees.update', 'test')); ?>" method="POST">
                    <?php echo e(method_field('PATCH')); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <input type="hidden" name="employee_id" id="emp_id" value="">
                        <!-- FULL NAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control form-control-sm  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="name" placeholder="Full Name" required autocomplete="name" id="full_name">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail Address</label>
                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="email" placeholder="E-mail Address" required autocomplete="email" autofocus id="email_address">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                        </div>

                        <!-- USERNAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="username" placeholder="Username" required autocomplete="username" autofocus id="username">
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- ADDRESS TEXTBOX -->
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="address" placeholder="Address" id="address">
                                </div>
                            </div>

                        <div class="form-row">
                            <!-- PHONENUMBER TEXTBOX -->
                            <div class="form-group col-md-6">
                                <label for="phonenumber">Phone Number</label>
                                <input type="number" class="form-control form-control-sm"
                                       name="phonenumber" placeholder="Phone Number" id="phonenumber">
                            </div>
                            <!-- POSITION COMBOBOX-->
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        id="role" autofocus >
                                    <option selected>Barber</option>
                                    <option>Receptionist</option>
                                    <option>User</option>
                                </select>
                                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addemployeemodal" tabindex="-1" role="dialog" aria-labelledby="addemployeemodallabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addemployeemodal">Add a new Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="/employees">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <!-- FULL NAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control form-control-sm  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" placeholder="Full Name" required autocomplete="name" autofocus>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">E-mail Address</label>
                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" placeholder="E-mail Address" required autocomplete="email">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            </div>
                        </div>

                        <!-- USERNAME TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" placeholder="Username" required autocomplete="username">
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- PASSWORD TEXTBOX -->
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-sm <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" placeholder="Password" required autocomplete="password">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <!-- ADDRESS TEXTBOX -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="address" placeholder="Address" required autocomplete="address">
                                <?php $__errorArgs = ['addrees'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- PHONENUMBER TEXTBOX -->
                            <div class="form-group col-md-4">
                                <label for="phonenumber">Phone Number</label>
                                <input type="number" class="form-control form-control-sm <?php $__errorArgs = ['phonenumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="phonenumber" placeholder="Phone Number" required autocomplete="phonenumber">
                                <?php $__errorArgs = ['phonenumber'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- POSITION COMBOBOX-->
                            <div class="form-group col-md-2">
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option selected>Barber</option>
                                    <option>Receptionist</option>
                                    <option>User</option>
                                </select>
                                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <!-- Add Employee Button-->
                        <input class="btn btn-primary btn-sm" type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    //EDIT MODAL IN EMPLOYEE
    $('#editemployee').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)
    var emp_id = button.data('myempid')
    var full_name = button.data('myfullname')
    var email_address = button.data('myemailaddress')
    var username = button.data('myusername')
    var role = button.data('myrole')
    var address = button.data('myaddress')
    var phonenumber = button.data('myphonenumber')
    var modal = $(this)

    modal.find('.modal-body #emp_id').val(emp_id);
    modal.find('.modal-body #full_name').val(full_name);
    modal.find('.modal-body #email_address').val(email_address);
    modal.find('.modal-body #username').val(username)
    modal.find('.modal-body #role').val(role);
    modal.find('.modal-body #address').val(address);
    modal.find('.modal-body #phonenumber').val(phonenumber);
    })
    </script>

</html>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\Metrobarbers\resources\views/sidebar/employees.blade.php ENDPATH**/ ?>