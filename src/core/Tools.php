<?php
namespace evondu\alipay\core;

/**
 * Class Tools
 * @package evondu\alipay\core
 */
class Tools{
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    public static function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = "UTF-8";
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
}