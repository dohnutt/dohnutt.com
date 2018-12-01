<?php


if ( ! function_exists('pretty_print_r') ) {
    function pretty_print_r( $data ) {
        echo '<pre style="font-size: 14px;height:90vh;overflow:scroll;">';
        print_r( $data );
        echo '</pre>';
    }
}
