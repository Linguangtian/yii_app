<?php
namespace api\dao;





/*
 * dao  只管取数据
 * */

trait TraitDao {

    /**
     * 数据过滤器 取字段或删字段
     * @param $data
     * @param $fields
     * @param bool $get true取fields字段 false过滤fields字段
     * @return array $data
     */
    public function dataFilter(array $data, $fields, $get=true) {
        foreach ($data as $key => $val) {
            if ($get && !in_array($key, $fields)) {
                unset($data[$key]);
            }
            if (!$get && in_array($key, $fields)) {
                unset($data[$key]);
            }
        }
        return $data;
    }


    public function hello(){

        echo 'hello';exit;
    }

}





?>