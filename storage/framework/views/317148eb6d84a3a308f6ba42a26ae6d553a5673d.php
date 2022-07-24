

<?php $__env->startSection('style'); ?>
<link rel='stylesheet' href='<?php echo e(asset('css/home.css')); ?>'>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src='<?php echo e(asset('js/cerca_utenti.js')); ?>' defer></script>
<script> const BASE_URL="<?php echo e(url('/')); ?>/";  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("title"); ?>
        <h1>
            <strong>Ricerca utenti</strong><br />
        </h1>
  <?php $__env->stopSection(); ?>

<?php $__env->startSection('head_content'); ?>
<div class="search_people">
        <label>Ricerca Utenti<input type="search" id="search_people"></label>
        <div class="btnCerca">
            <button class="CercaUtente">Ricerca Utente</button>
            <button class="TuttiUtenti">Visualizza tutti gli utenti</button>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('main_content'); ?>
    <div class="utenti hidden">

    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/search_people.blade.php ENDPATH**/ ?>