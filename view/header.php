<header class="row-between-center w-100">
    <h1><a href="home">Aurore.</a></h1>
    <nav class="row-center">
        <ul class="row-start-center">
            <li class="mr-4"><a href="gallery">Gallery</a></li>
            <?php if (!empty($_SESSION['user'])): ?>
                <li class="mr-4"><a href="manage">Manage</a></li>
                <li><a href="logout">Log out</a></li>
            <?php else: ?>
                <li><a href="login">Log in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>