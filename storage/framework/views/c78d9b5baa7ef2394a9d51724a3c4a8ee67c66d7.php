

<?php $__env->startSection('script'); ?>
<script src='<?php echo e(asset('js/signup.js')); ?>' defer></script>
<script type="text/javascript">
    const REGISTER_ROUTE = "<?php echo e(route('register')); ?>";
</script>
<script> const BASE_URL="<?php echo e(url('/')); ?>/";  </script>

<?php $__env->stopSection(); ?>

 
<?php $__env->startSection('content'); ?>
<h1>Presentati</h1>

<form name='signup' method='post' enctype="multipart/form-data" autocomplete="off" action="<?php echo e(route('register')); ?>">
    <?php echo csrf_field(); ?>
    <div class="names">
        <div class="name ">
            <div><label for='name'>Nome</label></div>
            <div><input type='text' name='name'></div>
            <span>Nome insolito</span>
        </div>
        <div class="surname ">
            <div><label for='surname'>Cognome</label></div>
            <div><input type='text' name='surname'></div>
            <span>Cognome insolito</span>
        </div>
    </div>
    <div class="username ">
        <div><label for='username'>Nome utente</label></div>
        <div><input type='text' name='username'></div>
        <span>&nbsp;</span>
    </div>
    <div class="email ">
        <div><label for='email'>Email</label></div>
        <div><input type='text' name='email'></div>
        <span>&nbsp;</span>
    </div>
    <div class="password ">
        <div><label for='password'>Password</label></div>
        <div><input type='password' name='password'></div>
        <span>&nbsp;</span>
    </div>
    <div class="confirm_password ">
        <div><label for='password_confirmation'>Conferma Password</label></div>
        <div><input type='password' name='password_confirmation'></div>
        <span>&nbsp;</span>
    </div>
    <div class="fileupload">
        <div><label for='avatar'>Scegli un'immagine profilo</label></div>
        <div>
            <input type='file' name='avatar' accept='.jpg, .jpeg, image/gif, image/png' id="upload_original">
            <div id="upload"><div class="file_name">Seleziona un file...</div><div class="file_size"></div></div>
        </div>
        <span>&nbsp;</span>
    </div>
    <div class="allow "> 
        <div><input type='checkbox' name='allow' value="1" ></div>
        <div><label for='allow'>Acconsento al trattamento dei dati personali</label></div>
    </div>
    <div class="submit">
        <input type='submit' value="Registrati" id="submit" >
    </div>

    <?php if(isset($error)): ?>

     <h1 class='errore'><?php echo e($error); ?> </h1>

    <?php endif; ?>

<div class="signup">Hai un account? <a href="<?php echo e(route('login')); ?>">Accedi</a>
</form>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/register.blade.php ENDPATH**/ ?>