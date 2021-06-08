<h1>FOOTER</h1>

<?php
    if (!empty($script_paths)) {
        foreach ($script_paths as $script_path) {
            echo '<script src="' . $script_path . '"></script>';
        }
    }
?>