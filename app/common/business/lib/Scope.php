<?php
/**
 *
 *
 * @description:  オラ!オラ!オラ!オラ!
 * @author: Shane
 * @time: 2020/6/22 14:28
 *
 */


namespace app\common\business\lib;


class Scope{
    private $PI = 3.14159265358979324;
    private $x_pi = 0;

    public function __construct(){
        $this -> x_pi = 3.14159265358979324 * 3000.0 / 180.0;
    }

    /**
     * 判断一个坐标是否在圆内
     * 思路：判断此点的经纬度到圆心的距离  然后和半径做比较
     * 如果此点刚好在圆上 则返回true
     * @param $point ['lng'=>'','lat'=>''] array指定点的坐标
     * @param $circle array ['center'=>['lng'=>'','lat'=>''],'radius'=>'']  中心点和半径
     * @return bool
     */
    public function isPointInCircle($point, $circle){

        $distance = $this -> distance($point['lat'], $point['lng'], $circle['center']['lat'], $circle['center']['lng']);
        if($distance <= $circle['radius']){
            return true;
        }else{
            return false;
        }
    }


    /**
     *  计算两个点之间的距离
     * @param $latA  第一个点的纬度
     * @param $lonA  第一个点的经度
     * @param $latB  第二个点的纬度
     * @param $lonB  第二个点的经度
     * @return float
     */
    private function distance($latA, $lonA, $latB, $lonB){
        $earthR = 6371000.;
        $x = cos($latA * $this -> PI / 180.) * cos($latB * $this -> PI / 180.) * cos(($lonA - $lonB) * $this -> PI / 180);
        $y = sin($latA * $this -> PI / 180.) * sin($latB * $this -> PI / 180.);
        $s = $x + $y;
        if ($s > 1) $s = 1;
        if ($s < -1) $s = -1;
        $alpha = acos($s);
        return $alpha * $earthR;
    }

}