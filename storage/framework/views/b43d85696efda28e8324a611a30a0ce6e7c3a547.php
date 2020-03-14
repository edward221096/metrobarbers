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

<?php $__env->startSection('customers'); ?>
    <div class="main_content">
        <div class="header">Manage Customer</div>
        <div class="info">
            <div class="form-header">Customer Form</div>

            <p></p>

            <!-- SHOW CUSTOMER DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Address</th>
                    <th>E-mail Address</th>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Membership Type</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($row->id); ?></td>
                        <td><?php echo e($row->name); ?></td>
                        <td><?php echo e($row->role); ?></td>
                        <td><?php echo e($row->address); ?></td>
                        <td><?php echo e($row->email); ?></td>
                        <td><?php echo e($row->username); ?></td>
                        <td><?php echo e($row->phonenumber); ?></td>
                        <td><?php echo e($row->gender); ?></td>
                        <td><?php echo e($row->membership_type); ?></td>

                        <td>
                            <!-- DELETE CUSTOMER DATA BASED FROM ID -->
                            <form action="customers/<?php echo e($row->id); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("DELETE"); ?>
                            <!-- EDIT DATA BY PASSING THE VALUE TO MODAL BUTTON BASED FROM ID-->
                                <a href="#" class="btn btn-secondary btn-sm"
                                   data-mycustid="<?php echo e($row->id); ?>"
                                   data-myfullname="<?php echo e($row->name); ?>"
                                   data-myrole="<?php echo e($row->role); ?>"
                                   data-myaddress="<?php echo e($row->address); ?>"
                                   data-myemailaddress="<?php echo e($row->email); ?>"
                                   data-myusername="<?php echo e($row->username); ?>"
                                   data-myphonenumber="<?php echo e($row->phonenumber); ?>"
                                   data-mygender="<?php echo e($row->gender); ?>"
                                   data-mymembershiptype="<?php echo e($row->membership_type); ?>"
                                   data-toggle="modal" data-target="#editcustomer">Edit</a>
                                <input class="btn btn-danger btn-sm" type="submit" name="submit" value="Delete">
                            </form>
                        </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <!-- PAGINATION -->
            <?php echo e($customer->links()); ?>

        </div>
    </div>

    <!-- EDIT CUSTOMER MODAL -->
    <div class="modal fade" id="editcustomer" tabindex="-1" role="dialog" aria-labelledby="editcustomerlabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editcustomer">Edit Customer Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo e(route('customers.update', 'test')); ?>" method="POST">
                    <?php echo e(method_field('PATCH')); ?>

                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <input type="hidden" name="customer_id" id="cust_id" value="">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="full_name">Full Name</label>
                                <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" id="full_name">
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
                                <label for="role">Role</label>
                                <select name="role" class="form-control form-control-sm" id="role">
                                    <option>Barber</option>
                                    <option>Receptionist</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>

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
unset($__errorArgs, $__bag); ?>" name="address" id="address">
                                    <?php $__errorArgs = ['address'];
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
                                    <label for="e-mail">E-mail Address</label>
                                    <input type="text" class="form-control form-control-sm <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" id="email_address">
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
unset($__errorArgs, $__bag); ?>" name="username" id="username">
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

                            <div class="form-group col-md-6">
                                <label for="phonenumber">Phonenumber</label>
                                <input type="text" class="form-control form-control-sm" name="phonenumber" id="phonenumber">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select name="gender" class="form-control form-control-sm" id="gender">
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="membership_type">Membership</label>
                                <select name="membership_type" class="form-control form-control-sm" id="membership_type">
                                    <option>Non-Member</option>
                                    <option>Member</option>
                                </select>
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

<!-- EDIT MODAL FOR CUSTOMER -->
    <script type="text/javascript">
        //EDIT MODAL IN EMPLOYEE
        $('#editcustomer').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var cust_id = button.data('mycustid')
            var full_name = button.data('myfullname')
            var role = button.data('myrole')
            var address = button.data('myaddress')
            var email_address = button.data('myemailaddress')
            var username = button.data('myusername')
            var phonenumber = button.data('myphonenumber')
            var gender = button.data('mygender')
            var membership_type = button.data('mymembershiptype')
            var modal = $(this)

            modal.find('.modal-body #cust_id').val(cust_id);
            modal.find('.modal-body #full_name').val(full_name);
            modal.find('.modal-body #role').val(role);
            modal.find('.modal-body #address').val(address);
            modal.find('.modal-body #email_address').val(email_address);
            modal.find('.modal-body #username').val(username)
            modal.find('.modal-body #phonenumber').val(phonenumber);
            modal.find('.modal-body #gender').val(gender);
            modal.find('.modal-body #membership_type').val(membership_type);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\Metrobarbers\resources\views/sidebar/customers.blade.php ENDPATH**/ ?>