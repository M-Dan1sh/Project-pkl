<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo e($data['title']); ?></title>
</head>
<body>

    <table>
        <tr>
            <th>Name</th>
            <th><?php echo e($data['name']); ?></th>
        </tr>
        <tr>
            <th>Email</th>
            <th><?php echo e($data['email']); ?></th>
        </tr>
        <tr>
            <th>Password</th>
            <th><?php echo e($data['password']); ?></th>
        </tr>
    </table>

    <a href="<?php echo e($data['url']); ?>">Klick disini untuk login ke akun anda</a>
    <p>Terima Kasih!</p>
    
</body>
</html><?php /**PATH D:\Project-PKL\web-pkl\resources\views/registrationMail.blade.php ENDPATH**/ ?>