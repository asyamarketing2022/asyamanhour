<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>
<?php $page = '404'; include_once('header.php') ?>
<?php include_once("sidebar.php"); ?>

<div class="grid-right__content pt-0 position-relative">
    <div class="page-restriction">
        <!-- <h1>404</h1> -->
        <img src="img/padlock.png" alt="">
        <p>You don't have permission to view this page</p>
    </div>
</div>

<?php include 'footer.php'; ?>
