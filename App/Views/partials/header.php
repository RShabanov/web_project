<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (!empty($css_paths)):
        foreach ($css_paths as $css_path): ?>
            <link rel="stylesheet" type="text/css" href="<?= $css_path; ?>" />
    <?php endforeach; endif; ?>

    <title>Calendar</title>

    
</head>
<h1>HEADER</h1>
<header class="main-header__header">
    <div class="site-title__div">My Calendar</div>
    <div class="header-links__div">
        <a href="/logout">Log out</button>
    </div>
</header>