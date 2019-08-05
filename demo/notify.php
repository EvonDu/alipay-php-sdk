<?php
//获取内容
file_put_contents(__DIR__."/logs/notify.log",json_encode($_POST),FILE_APPEND);

//应答通知
exit("success");