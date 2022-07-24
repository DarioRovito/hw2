

<?php $__env->startSection('content'); ?>
<h1>Benvenuto</h1>
<form name='login' method='post' action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>
    <div class="username ">
        <div><label for='username'>Nome utente</label></div>
        <div><input type='text' name='username' value='<?php echo e(old('username')); ?>'></div>
    </div>
    <div class="password ">
        <div><label for='password'>Password</label></div>
        <div><input type='password' name='password'></div>
    </div>
    <?php if(isset($error)): ?>

      <h1 class='errore'><?php echo e($error); ?> </h1>

    <?php endif; ?>
    <div>
        <input type='submit' value="Accedi">
    </div>
 

</form>
<div class="signup">Non hai un account? <a href="<?php echo e(route('register')); ?>">Iscriviti</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/login.blade.php ENDPATH**/ ?>