<?php $__env->startSection('mysessions'); ?>
    <div class="main_content">
        <div class="header">My Sessions</div>
        <div class="info">
            <div>View My Booked and Upcoming Sessions</div>
            <p></p>

            <!-- SHOW DATA IN A TABLE-->
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Session ID</th>
                    <th>Customer Name</th>
                    <th>Employee Name</th>
                    <th>Service Name</th>
                    <th>Cost</th>
                    <th>Start Date & Time</th>
                    <th>End Date & Time</th>
                    <th>Paid Amount</th>
                    <th>Change Amount</th>
                </tr>
                </thead>

                <tbody>
                <?php $__currentLoopData = $session; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($row->SID); ?></td>
                        <td><?php echo e($row->customer_name); ?></td>
                        <td><?php echo e($row->employee_name); ?></td>
                        <td><?php echo e($row->service_name); ?></td>
                        <td><?php echo e($row->cost); ?></td>
                        <td><?php echo e($row->start_time); ?></td>
                        <td><?php echo e($row->end_time); ?></td>
                        <td><?php echo e($row->paid_amount); ?></td>
                        <td><?php echo e($row->change_amount); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laravel\Metrobarbers\resources\views/sidebar/mysessions.blade.php ENDPATH**/ ?>