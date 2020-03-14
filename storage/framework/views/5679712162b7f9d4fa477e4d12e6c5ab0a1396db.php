<?php $__env->startSection('home'); ?>
    <div class="main_content">
        <div class="header">Book a Services</div>
        <div class="info">
            <div>Select and Pick a Hair Style and Appointment Date</div>

            <p></p>

            <!-- SHOW DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($row->id); ?></td>
                        <td><?php echo e($row->service_name); ?></td>
                        <td><?php echo e($row->description); ?></td>
                        <td><?php echo e($row->cost); ?></td>
                        <td><img src="<?php echo e(asset('uploads/service/' . $row->image)); ?>" width="100px;" height="100px;" alt="Image"></td>
                        <td>
                            <!-- EDIT FUNCTIONS TYPE BUTTON -->
                            <?php if(Auth::User()->role == 'Barber' || Auth::User()->role == 'Receptionist'): ?>
                                <?php else: ?>
                                <a href="#" class="btn btn-primary btn-default"
                                   data-myserviceid="<?php echo e($row->id); ?>"
                                   data-myuserid="<?php echo e(Auth::user()->id); ?>"
                                   data-myservicename="<?php echo e($row->service_name); ?>"
                                   data-mydescription="<?php echo e($row->description); ?>"
                                   data-toggle="modal" data-target="#booksession">Book</a>
                                <?php endif; ?>
                        </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- EDIT Service Modal -->
    <div class="modal fade" id="booksession" tabindex="-1" role="dialog" aria-labelledby="booksessionlabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="booksession">Book a Session</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/storesession" method="POST">
                    <?php echo e(csrf_field()); ?>

                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="userid">User ID</label>
                                <input type="text" class="form-control form-control-sm" name="userid" id="userid" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="servid">Service ID</label>
                                    <input type="text" class="form-control form-control-sm" name="servid" id="servid" readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">Description</label>
                                <textarea type="text" rows="5" class="form-control form-control-sm" name="description" id="description" readonly></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="emp_id">Barber</label>
                                <select name="emp_id" class="form-control form-control-sm" value="text">
                                    <?php $__currentLoopData = App\Employee::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($employee->id); ?>"><?php echo e($employee->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="datetime">Date and Time</label>
                                    <input type='datetime-local' class="form-control form-control-sm <?php $__errorArgs = ['datetime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="datetime"/>
                                        <?php $__errorArgs = ['datetime'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert" autofocus>
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

    <script type="text/javascript">

        //EDIT MODAL IN EMPLOYEE
        $('#booksession').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var servid = button.data('myserviceid')
            var service_name = button.data('myservicename')
            var description = button.data('mydescription')
            var userid = button.data('myuserid')
            // var role = button.data('myrole')
            // var address = button.data('myaddress')
            // var phonenumber = button.data('myphonenumber')
            var modal = $(this)

            modal.find('.modal-body #servid').val(servid);
            modal.find('.modal-body #service_name').val(service_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #userid').val(userid)
            // modal.find('.modal-body #role').val(role);
            // modal.find('.modal-body #address').val(address);
            // modal.find('.modal-body #phonenumber').val(phonenumber);
        })
        //DATE TIME PICKER
        $(function () {
            $('#bookdatetime').datetimepicker();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\Metrobarbers\resources\views/home.blade.php ENDPATH**/ ?>