<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (!empty($css_paths)):
        foreach ($css_paths as $css_path): ?>
            <link rel="stylesheet" type="text/css" href="<?= $css_path; ?>" />
    <?php endforeach; endif; ?>

    <link rel="stylesheet" type="text/css" href="/Static/css/partials/header.css">

    <title>Calendar</title>

    
</head>
<header class="main-header__header">
    <div class="site-title__div">My Calendar</div>
    <div class="header-links__div">
        <a class="logout-btn" href="/logout">Log out</a>
    </div>
</header>