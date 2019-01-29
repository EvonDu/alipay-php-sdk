<?php
namespace evondu\alipay;

class RequestParams{
    static function checkRequire($params, Array $names = []){
        $keys = array_keys($params);
        foreach ($names as $item){
            if(is_array($item)){
                if(empty(array_intersect($item, $keys)))
                    throw new \Exception("missing parameter : [ ".implode(" | ", $item)." ]");
            }
            else{
                if(!in_array($item, $keys) === null)
                    throw new \Exception("missing parameter : $item");
            }
        }
    }
}