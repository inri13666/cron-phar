<?php

$libName = 'cron-expression';
$libDir = 'cron-expression/src';
$buildDir = 'build';
$outName = $buildDir . '/' . $libName;

if(!is_dir($buildDir))
  if(!mkdir($buildDir))
    throw new Exception('Error: Can\'t create new folder.');

/* Remove Previous Compiled Archives */
if(is_readable($outName))
  delete($outName);

$archiveObj = new Phar($outName . '.phar', 0, $libName);
$archiveObj->buildFromDirectory($libDir);
$archiveObj->addFile('phar-bs.php');
$archiveObj->setStub($archiveObj->createDefaultStub('phar-bs.php'));

$archiveObj = null;
unset($archiveObj);
