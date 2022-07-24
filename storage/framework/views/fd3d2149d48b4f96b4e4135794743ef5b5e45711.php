


<?php $__env->startSection('style'); ?>
<link rel='stylesheet' href='<?php echo e(asset('css/home.css')); ?>'>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src='<?php echo e(asset('js/home.js')); ?>' defer></script>
<script> const BASE_URL="<?php echo e(url('/')); ?>/";  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('profile'); ?>
<section id="profile" data-user="<?php echo e($user['username']); ?>">        
    <div class="avatar"  style="background-image:url('<?php echo e('data:image/jpg;charset=utf8;base64,'.base64_encode($user['propic'])); ?>')"></div>
    <div class="name">
    <?php echo e($user['name']); ?> <?php echo e($user['surname']); ?>

    </div>
    <div class="username">
        <?php echo e('@'.$user['username']); ?> 
    </div>
    <a  class="visualizza"  href="<?php echo e(route('profilo')); ?>">Visualizza profilo</a>
    <div class="information">
        <div>
            <span class="count"><?php echo e($user['nposts']); ?> </span><br>Posts
        </div>
        <div id="view_followers">
            <span class="count"><?php echo e($user['nfollowers']); ?> </span><br>followers
        </div>
        <div id="view_following">
            <span class="count"><?php echo e($user['nfollowing']); ?> </span><br>following
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.object', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/home.blade.php ENDPATH**/ ?>