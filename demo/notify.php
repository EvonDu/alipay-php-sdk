<?php
file_put_contents(__DIR__."/logs/notify.log",json_encode($_POST),FILE_APPEND);