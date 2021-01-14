<?php



require_once 'src/Knp/Snappy/image.php';

        $testObject = new Image();
       


        $testObject->setOption('use-xserver', true);
        $testObject->setOption('enable-smart-width', true);
  
print_r(    $testObject);
