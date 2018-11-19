<?php
/**
 * Update Classes to be Tested
 *
 */

$file = fopen('../src/tests.php', 'w');
$preamble = "<?php\n\n".'/'.'/'.'To update tests run /sys/update_tests.php'."\n\n";
fwrite($file, $preamble);
foreach (glob('../src/Models/*.php') as $route) {
    $route = explode('../src/', $route)[1];
    $line = "require_once '" . $route . "';\n";
    fwrite($file, $line);
}
fclose($file);