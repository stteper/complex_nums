<?php
/**
 *
 */
require_once './vendor/autoload.php';

use Math\ComplexNumber;
?>
<h1>Test OK</h1>
<?php
    echo new ComplexNumber(4,5);

    $res = (new ComplexNumber(5,7))->mul(new ComplexNumber(-4, -6));
    echo $res;


