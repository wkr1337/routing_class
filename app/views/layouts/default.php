<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- <script src="./js/script.js"></script> -->
    <link rel="stylesheet" type="text/css" href="<?=PROOT?>public/css/formStyle.css">
    <link rel="stylesheet" type="text/css" href="<?=PROOT?>public/css/style.css">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="<?=PROOT?>public/css/bootstrap.min.css">

    <!-- Add icon library -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
        crossorigin="anonymous">
    <?= $this->content('head'); ?>
    <title><?= $this->getSiteTitle(); ?></title>
</head>
<body>
<div class="bg-danger"><?=$this->displayErrors ?></div>
<div class="bg-danger"><?=$this->getViewError() ?></div>


<?= $this->content('body'); ?>
<?= include_once(ROOT . DS . 'app' . DS . 'views' . DS . 'inc' . DS . 'navbar.php'); ?>
<?= include_once(ROOT . DS . 'app' . DS . 'views' . DS . 'register' . DS . 'loginModal.php'); ?>
<?= include_once(ROOT . DS . 'app' . DS . 'views' . DS . 'register' . DS . 'registerModal.php'); ?>


<?= include_once(ROOT . DS . 'app' . DS . 'views' . DS . 'inc' . DS . 'footer.php'); ?>
</body>
</html>