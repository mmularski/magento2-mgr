<?php 

$stime = microtime(true);

//shell_exec('/home/www/magento2/www/magento2.dev/vendor/bin/phpcs /home/www/magento2/www/magento2.dev/app/code/MMularczyk');
//shell_exec('/home/www/magento2/www/magento2.dev/vendor/bin/phpmd /home/www/magento2/www/magento2.dev/app/code/MMularczyk text /home/www/magento2/www/magento2.dev/dev/tests/static/testsuite/Magento/Test/Php/_files/phpmd/ruleset.xml');
//$output = shell_exec('/home/www/magento2/www/sniffers/phpstan/vendor/bin/phpstan analyse /home/www/magento2/www/magento2.dev/app/code/MMularczyk/');
//$output = shell_exec('/home/www/magento2/www/magento2.dev/vendor/phpunit/phpunit/phpunit --configuration /home/www/magento2/www/magento2.dev/dev/tests/unit/phpunit.xml.dist --teamcity');
//$output = shell_exec('/home/www/magento2/www/magento2.dev/dev/tests/acceptance/vendor/bin/codecept run integration');
$output = shell_exec('/home/www/magento2/www/magento2.dev/vendor/phpunit/phpunit/phpunit --configuration /home/www/magento2/www/magento2.dev/dev/tests/integration/phpunit.xml.dist --teamcity');

$endtime = microtime(true);

echo PHP_EOL."Elapsed time: ".(($endtime-$stime)*1000)."ms.".PHP_EOL;

