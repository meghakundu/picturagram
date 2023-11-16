<!DOCTYPE html>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
 document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: <?php echo json_encode($events, 15, 512) ?>,
                });
                calendar.render();
            });
    </script>
    <div id='calendar'></div>
        </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\pictura-app-main\resources\views/pages/posts/post-timeline.blade.php ENDPATH**/ ?>