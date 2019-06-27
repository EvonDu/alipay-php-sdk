<?php
file_put_contents(__DIR__."/notify.log",json_encode($_POST)."\n",FILE_APPEND);