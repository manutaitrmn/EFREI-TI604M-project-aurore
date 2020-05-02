<?php $title = "Aurore" ?>

<?php $css = "public/css/home.css" ?>

<?php ob_start(); ?>

<section class="wrapper w-100 h-100 relative">
    <div class="background w-100 h-100 absolute"></div>
    <div class="front w-100 h-100 col-start-center absolute">

        <?php require_once "header.php" ?>

        <div class="intro col-start-center">
            <p>Have a seat with us and get instant inspiration.</p>
            <a href="gallery">Explore</a>
        </div>

    </div>
</section>

<?php require "footer.php" ?>

<?php $content = ob_get_clean(); ?>

<?php require "template.php" ?>