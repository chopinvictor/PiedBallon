<?php

function alert($msg) { 
    echo "<script type='text/javascript'>alert('".$msg."');</script>";
}

function redirect($route) {
    echo "<script> window.setTimeout(function() {
        window.location = '".$route."';}, 50);
    </script>";
}