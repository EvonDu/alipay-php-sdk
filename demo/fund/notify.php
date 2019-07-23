<?php
file_put_contents(__DIR__."/../logs/notify_fund.log",json_encode($_POST)."\n",FILE_APPEND);