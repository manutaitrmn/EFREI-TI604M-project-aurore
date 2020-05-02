<?php $title = "Aurore" ?>

<?php $css = "public/css/login.css" ?>

<?php ob_start(); ?>

    <section class="wrapper w-100 h-100 relative">
        <div class="background w-100 h-100 absolute"></div>
        <div class="front w-100 h-100 col-start-center absolute">

            <?php require_once "header.php" ?>

            <div class="w-100 row-center m-auto">
                <form action="manage" method="post" class="col-start-center shadow mr-2">
                    <fieldset class="w-100">
                        <legend class="m-auto">Add image</legend>
                        <input type="text" name="url" placeholder="Image URL" required>
                        <textarea name="description" placeholder="Image description"></textarea>
                        <input type="submit" value="Add">
                        <?php if (isset($addResponse)): ?>
                            <p class="alert"><?= $addResponse ?></p>
                        <?php endif; ?>
                    </fieldset>
                </form>
                <form action="manage" method="post" class="col-start-center shadow">
                    <fieldset class="w-100">
                        <legend class="m-auto">Delete image</legend>
                        <input type="text" name="id" placeholder="Image ID" required>
                        <input type="submit" value="Delete">
                        <?php if (isset($delResponse)): ?>
                            <p class="alert"><?= $delResponse ?></p>
                        <?php endif; ?>
                    </fieldset>
                </form>
            </div>

        </div>
    </section>

<?php require "footer.php" ?>

<?php $content = ob_get_clean(); ?>

<?php require "template.php" ?>