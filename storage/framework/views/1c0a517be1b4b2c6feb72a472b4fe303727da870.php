<!DOCTYPE html>

<head>
<meta charset="utf-8">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">


   <?php echo $__env->yieldContent('style'); ?>
   <script type="text/javascript">
       const CSFR_TOKEN = '<?php echo e(csrf_token()); ?>';
   </script>
    <?php echo $__env->yieldContent('script'); ?>


</head>

<body>
    <header>
        <div id="overlay"></div>
        <nav>
   <div id="titolo">Sportify</div>
   <div class="links">
   <ul>
   <a href="<?php echo e(route('home')); ?>">HOME</a>
   <a href="<?php echo e(route('search_people')); ?>">Ricerca Utenti</a>
   <a href="<?php echo e(route('New')); ?>">Nuovo Post</a>
   <a  href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">Logout</a>



<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>
     </ul>
            </div>

            <div id="sidebar_button">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>

        <?php echo $__env->yieldContent('title'); ?>
        
    </header>
    
    <?php echo $__env->yieldContent('head_content'); ?>
    
    <?php echo $__env->yieldContent('profile'); ?>

    <?php echo $__env->yieldContent('main_content'); ?>




</section>
    <!--SIDEBAR-->
    <section id="sidebar" class="hidden">
        <div class="side" id="sidebar_links">
   <ul>
   <a href="<?php echo e(route('home')); ?>">HOME</a>
   <a href="<?php echo e(route('search_people')); ?>">Ricerca Utenti</a>
   <a href="<?php echo e(route('New')); ?>">Nuovo Post</a>
   <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
   document.getElementById('logout-form').submit();">Logout</a>
  </ul>
</section>

<section id="modale_like" class="hidden">
</section>

</body>

<footer>
    <p>
        Developed by Dario Rovito
    </p>
</footer>

</html><?php /**PATH C:\xampp\htdocs\homework2-app\resources\views/layouts/site.blade.php ENDPATH**/ ?>