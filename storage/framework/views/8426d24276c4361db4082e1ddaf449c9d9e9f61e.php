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


<?php $__env->startSection('employeestimeinout'); ?>
    <div class="main_content">
        <div class="header">Manage Employee Time In and Out</div>
        <div class="info">
            <div class="form-header">Employee Table</div>
            <p>Date and Time: <span id="datetime"></span></p>

            <form method="POST" action="/employeestimeinout">

            <?php echo e(csrf_field()); ?>

            <!-- USER ID -->
                    <label for="id">User ID</label>
                    <div class="form-inline">
                        <input type="text" value="<?php echo e(Auth::User()->id); ?>" class="form-control form-control-sm" name="id" readonly>

                    </div>
            <!-- STATUS ID -->
                    <label for="status">Status</label>
                    <div class="form-inline">
                        <select name="status" class="form-control form-control-sm mr-1" value="status">
                            <option selected>Present</option>
                            <option>Absent</option>
                            <option>On-Training</option>
                        </select>
            <!-- TIME IN BUTTON -->
                        <input class="btn btn-primary btn-sm" name="submit" type="submit" value="Time In">
                    </div>
            </form>

            <table class="table table-striped">
        <thead>
        <tr>
            <th>Timelog ID</th>
            <th>Name</th>
            <th>Role</th>
            <th>Workday</th>
            <th>Status</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row->tid); ?></td>
                <td><?php echo e($row->name); ?></td>
                <td><?php echo e($row->role); ?></td>
                <td><?php echo e($row->day); ?></td>
                <td><?php echo e($row->status); ?></td>
                <td><?php echo e($row->timein); ?></td>
                <td><?php echo e($row->timeout); ?></td>
                <td>
                    <?php if($row->uid <> Auth::User()->id): ?>
                    <?php else: ?>
                    <form method="POST" action="<?php echo e(url('/employeestimeout').'/'.$row->tid); ?>">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="PATCH"/>

                        <input class="btn btn-primary btn-sm" type="submit" value="Time Out">
                    </form>
                        <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
            <?php echo e($employee->links()); ?>

    </div>
    </div>


    <script type="text/javascript">
        var dt = new Date();
        document.getElementById("datetime").innerHTML = dt.toLocaleString();
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\Metrobarbers\resources\views/sidebar/employeestimeinout.blade.php ENDPATH**/ ?>