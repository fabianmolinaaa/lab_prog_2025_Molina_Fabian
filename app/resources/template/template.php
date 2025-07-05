<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once APP_DIR_TEMPLATE . 'includes/head.php';

        //* Styles
        if(isset($this->styles) && is_array($this->styles)){
            foreach($this->styles as $style){
                echo '<link rel="stylesheet" href="' . APP_URL . $style . '">' . PHP_EOL;
            }
        }
        
        //* Scripts
        if(isset($this->scripts) && is_array($this->scripts)){
            foreach($this->scripts as $script){
                echo '<script defer src="' . APP_URL . $script . '"></script>';
            }
        }
    ?>
</head>
<body>
    <!-- <header>
        <?php
            require_once APP_DIR_TEMPLATE . "includes/menu.php";
        ?>
    </header> -->
    <!-- <main> -->
        <?php
            require_once APP_DIR_VIEWS . $this->view;
        ?>
    <!-- </main> -->
    <!-- <footer>
        <?php
            require_once APP_DIR_TEMPLATE . "includes/footer.php";
        ?>
    </footer> -->
</body>
</html>