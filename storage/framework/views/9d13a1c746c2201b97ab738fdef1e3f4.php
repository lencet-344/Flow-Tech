<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SINGKI</title>
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/favicon.png')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased text-gray-900">
    <?php echo $__env->yieldContent('content'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\Flow-Tech\resources\views/layouts/empty.blade.php ENDPATH**/ ?>