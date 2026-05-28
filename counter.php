<?php
$counterFile = 'visits.txt';

if (!file_exists($counterFile)) {
    file_put_contents($counterFile, '0', LOCK_EX);
}

$handle = fopen($counterFile, 'c+');
if ($handle) {
    if (flock($handle, LOCK_EX)) {
        $count = (int)fread($handle, filesize($counterFile) ?: 1);
        $count++;
        ftruncate($handle, 0);
        rewind($handle);
        fwrite($handle, (string)$count);
        flock($handle, LOCK_UN);
    } else {
        $count = (int)file_get_contents($counterFile);
    }
    fclose($handle);
} else {
    $count = (int)file_get_contents($counterFile);
}

// إرجاع العدد كاستجابة نصية فقط
echo $count;
