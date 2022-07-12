

<?php $__env->startSection('style'); ?>
<link rel='stylesheet' href='<?php echo e(asset('css/new_post.css')); ?>'>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src='<?php echo e(asset('js/new_post.js')); ?>' defer></script>
<script> const BASE_URL="<?php echo e(url('/')); ?>/";  </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection("title"); ?>
<h1>
            <strong>Crea il tuo nuovo post</strong><br/>
        </h1>
  <?php $__env->stopSection(); ?>

<?php $__env->startSection('head_content'); ?>
<article>
<form name='search_content' id='search' autocomplete="off" >
<?php echo csrf_field(); ?>

            <h1>Ricerca post</h1>

            <input type='text' name='content' id='content'>

            <select name='type' id='tipo'>
                <option value='sports'>Sports</option>
                <option value='giphy'>Giphy</option>
                <option value='spotify'>Spotify</option>
            </select>

            <label>&nbsp;<input class="submit" type='submit'></label>
        </form>
    </article>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>

<section class="box_container">

<div id="contents">
</div>

</section>

<section id="modale" class="hidden" >
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/New.blade.php ENDPATH**/ ?>