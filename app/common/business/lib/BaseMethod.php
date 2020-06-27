<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/18 上午9:14
 *
 */


namespace app\common\business\lib;

use app\BaseController;
use think\db\exception\DbException;
use think\facade\Db;

class BaseMethod extends BaseController
{


    /**查
     * @param $tableName
     * @param $key
     * @param $value
     * @return string|\think\Collection
     */
    public function Retrieve($tableName, $key, $value){
        try {
            return Db::name($tableName) -> where($key, $value) -> select();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    /**改
     * @param $tableName
     * @param $id
     * @param $data
     * @return int|string
     */
    public function Update($tableName, $id, $data){
        try {
            return Db::name($tableName) -> where('id', $id) -> data($data) -> update();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    /**删
     * @param $tableName
     * @param $id
     * @return string
     */
    public function Delete($tableName, $id){
        try {
            return Db::table($tableName)->where('id',$id)->delete();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    /**增
     * @param $tableName
     * @param $data
     * @return int|string
     */
    public function Create($tableName, $data){
        try {
            return Db::name($tableName)->strict(false)->insert($data);
        }catch (DbException $exception){
            return $exception -> getMessage();
        }

    }
    /**遍历
     * @param $tableName
     * @return array
     */
    public function throwAll($tableName){
        $str = "SELECT * FROM `$tableName`";
        return Db::query($str);
    }

    /**批量删除
     * @param $tableName
     * @param $ids
     * @return string
     */
    public function batchDelete($tableName, $ids){
        try {
            foreach ($ids as $id) {
                Db::table($tableName)->where('id',$id)->delete();
            }
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

}