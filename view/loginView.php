<?php $title = "Aurore" ?>

<?php $css = "public/css/login.css" ?>

<?php ob_start(); ?>

    <section class="wrapper w-100 h-100 relative">
        <div class="background w-100 h-100 absolute"></div>
        <div class="front w-100 h-100 col-start-center absolute">

            <?php require_once "header.php" ?>
            
            <form action="login" method="post" class="col-start-center m-auto shadow">
                <fieldset class="w-100">
                    <legend class="m-auto">Log in</legend>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" value="Log in">
                    <?php if (isset($response)): ?>
                        <p class="alert"><?= $response ?></p>
                    <?php endif; ?>
                </fieldset>
            </form>

        </div>
    </section>

<?php require "footer.php" ?>

<?php $content = ob_get_clean(); ?>

<?php require "template.php" ?>