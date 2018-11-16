<?php
/**
 * Update Routes.php
 *
 */
$file = fopen('../src/routes.php', 'w');
$preamble = "<?php\n\n".'/'.'/'.'To update routes run /sys/update_routes.php'."\n\n";
fwrite($file, $preamble);
foreach (glob('../src/Routes/*.php') as $route) {
    //$route = explode('../', $path)[1];
    $line = "require_once '" . $route . "';\n";
    fwrite($file, $line);
}
fclose($file);