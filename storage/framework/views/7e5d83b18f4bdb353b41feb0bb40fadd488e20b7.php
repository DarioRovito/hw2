<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('site.name', 'Laravel')); ?> <?php echo $__env->yieldContent('title'); ?></title>

    <link rel='stylesheet' href='<?php echo e(asset('css/signup.css')); ?>'>
    <?php echo $__env->yieldContent('script'); ?>
    
    </head>
<body>
<main class="login">
<section class="section_main">
     <?php echo $__env->yieldContent('content'); ?>
        </section>

    </main>
</body>


<footer>
    <p>
        Developed by Dario Rovito
    </p>
</footer>

</html>


<?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/layouts/guest.blade.php ENDPATH**/ ?>