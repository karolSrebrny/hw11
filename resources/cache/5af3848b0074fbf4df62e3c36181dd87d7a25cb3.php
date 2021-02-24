

<?php $__env->startSection('title', 'Homepage'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="m-3">Homepage</h2>

    <div class="mb-3">
        <a class="btn btn-secondary" href="/categories">Categories</a>
    </div>
    <div class="mb-3">
        <a class="btn btn-secondary" href="/posts">Posts</a>
    </div>
    <div class="mb-3">
        <a class="btn btn-secondary" href="/tags">Tags</a>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/hw11_1.test/resources/views/index.blade.php ENDPATH**/ ?>