<?php
$i = 1;
while (true) {
    $output = shell_exec('/home/www/magento2/www/magento2.dev/dev/tests/acceptance/vendor/bin/codecept run integration');

    echo PHP_EOL . 'TIME: ' . $i . PHP_EOL;
    $i++;
    usleep(500);
}


