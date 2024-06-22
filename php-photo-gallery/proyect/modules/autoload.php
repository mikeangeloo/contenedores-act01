<?php

spl_autoload_register(function ($Class) {
    require("modules/".$Class.".Class.php");
});

?>