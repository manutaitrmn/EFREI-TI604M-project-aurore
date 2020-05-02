<?php
$title = "Aurore - Gallery";
$css = "public/css/gallery.css";
?>

<?php ob_start(); ?>

<section class="wrapper w-100 h-50 relative">
    <div class="background w-100 h-100 absolute"></div>
    <div class="front w-100 h-100 col-between-center absolute">

        <?php require_once "header.php" ?>

        <div class="intro col-end-center">
            <p>Browse the gallery.</p>
            <form action="gallery/" method="get" onsubmit="return SubmitForm()">
                <input id="search-bar" name="q" type="text" placeholder="Search images" value="<?= isset($_GET['q'])?$_GET['q']:'' ?>" autocomplete="off">
            </form>
        </div>

    </div>
</section>

<section class="images-wrapper w-100 row-start nowrap">

    <?php if (count($images) > 0): ?>

    <?php
    $i=1;
    $col[] = null;
    foreach ($images as $image) {
        if ($i == 5) {$i = 1;}
        $col[$i] .= "<div class='img-wrap shadow w-100'><img class='w-100' src='".$image['url']."' alt=''><div class='img-info w-100'><p class='img-author'>(".$image['id'].") by <strong>".$image['username']."</strong></p><p class='img-description'>".$image['description']."</p></div></div>
";
        $i++;
    }
    ?>

    <div class="img-col hli-4-1 col-start"><?= $col[1]; ?></div>
    <div class="img-col hli-4-1 col-start"><?= $col[2]; ?></div>
    <div class="img-col hli-4-1 col-start"><?= $col[3]; ?></div>
    <div class="img-col hli-4-1 col-start"><?= $col[4]; ?></div>

    <?php else: ?>

    <p>Nothing for the moment. Come back later!</p>

    <?php endif; ?>

</section>

<?php require "footer.php" ?>

<script>
    /**
     * @return {boolean}
     */
    function SubmitForm() {
        const val = document.getElementById('search-bar').value;
        window.location.href='/aurore/gallery/' + val;
        return false;
    }
</script>

<?php $content = ob_get_clean(); ?>

<?php require "template.php" ?>