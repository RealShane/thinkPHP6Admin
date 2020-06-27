<?php
/**
 *
 *
 * @description:  オラ!オラ!オラ!オラ!
 * @author: Shane
 * @time: 2020/6/22 17:03
 *
 */


namespace app\common\business\lib;


class WxPay
{

    /** 公共
     * @var string|null
     */
    private $nonce_str = null;
    private $key = null;
    private $apiclient_cert = null;
    private $apiclient_key = null;
    /** 红包配置
     * @var string|null
     */
    private $mch_billno = null;
    private $mch_id = null;
    private $wxappid = null;
    //商户名称
    private $send_name = null;
    private $re_openid = null;
    private $total_amount = null;
    private $total_num = null;
    //红包祝福语
    private $wishing = null;
    private $client_ip = null;
    //活动名称
    private $act_name = null;
    //备注
    private $remark = null;

    /** 付款配置
     * @var string|null
     */

    private $mch_appid = null;
    private $mchid = null;
    private $partner_trade_no = null;
    private $openid = null;
    private $check_name = null;
    private $amount = null;
    //企业付款备注
    private $desc = null;

    public function __construct($type, $config){
        $this -> nonce_str = md5(time());
        $this -> key = $config['key'];
        $this -> apiclient_cert = $config['apiclient_cert'];
        $this -> apiclient_key = $config['apiclient_key'];
        if ($type == 'red_pack'){
            $this -> mch_billno = $config['mch_billno'];
            $this -> mch_id = $config['mch_id'];
            $this -> wxappid = $config['wxappid'];
            $this -> send_name = $config['send_name'];
            $this -> re_openid = $config['re_openid'];
            $this -> total_amount = $config['total_amount'];
            $this -> total_num = $config['total_num'];
            $this -> wishing = $config['wishing'];
            $this -> client_ip = request() -> ip();
            $this -> act_name = $config['act_name'];
            $this -> remark = $config['remark'];
        }
        if ($type == 'pay'){
            $this -> mch_appid = $config['mch_appid'];
            $this -> mchid = $config['mchid'];
            $this -> partner_trade_no = $config['partner_trade_no'];
            $this -> openid = $config['openid'];
            $this -> check_name = $config['check_name'];
            $this -> amount = $config['amount'];
            $this -> desc = $config['desc'];
        }
    }

    public function pay(){
        $data = [
            'mch_appid' => $this -> mch_appid,
            'mchid' => $this -> mchid,
            'nonce_str' => $this -> nonce_str,
            'partner_trade_no' => $this -> partner_trade_no,
            'openid' => $this -> openid,
            'check_name' => $this -> check_name,
            'amount' => $this -> amount,
            'desc' => $this -> desc
        ];
        $data['sign'] = $this -> getPaySign($data);


        $xml_data = $this -> array_to_xml($data);
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers';

        //发送post请求
        $res = $this -> curl_post_ssl($url, $xml_data);
        if(!$res){
            return config("failed");
        }

        return $this -> xml_to_array($res);
    }

    public function sendRedPack(){
        $data = [
            'nonce_str' => $this -> nonce_str,
            'mch_billno' => $this -> mch_billno,
            'mch_id' => $this -> mch_id,
            'wxappid' => $this -> wxappid,
            'send_name' => $this -> send_name,
            're_openid' => $this -> re_openid,
            'total_amount' => $this -> total_amount,
            'total_num' => $this -> total_num,
            'wishing' => $this -> wishing,
            'client_ip' => $this -> client_ip,
            'act_name' => $this -> act_name,
            'remark' => $this -> remark
        ];
        $data['sign'] = $this -> getRedPackSign($data);


        $xml_data = $this -> array_to_xml($data);
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';

        //发送post请求
        $res = $this -> curl_post_ssl($url, $xml_data);
        if(!$res){
            return config("failed");
        }

        return $this -> xml_to_array($res);
    }

    public function curl_post_ssl($url, $xmldata, $second=30, $aHeader=array()){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_TIMEOUT,$second);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);

        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT,$this -> apiclient_cert);
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY,$this -> apiclient_key);
        if(count($aHeader) >= 1){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
        }
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$xmldata);
        $data = curl_exec($ch);
        if($data){
            curl_close($ch);
            return $data;
        }else{
            $error = curl_errno($ch);
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            exit;
        }
    }

    public function array_to_xml($arr){
        $xml = "<xml>";
        foreach ($arr as $key => $val){
            if (is_numeric($val)){
                $xml .= "<" .$key.">".$val."</".$key.">";
            }else{
                $xml .= "<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    public function xml_to_array($xml){
        libxml_disable_entity_loader(true);
        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
    }

    public function getRedPackSign($data){
        $str = 'act_name=' . $data['act_name'] .
               '&client_ip=' . $data['client_ip'] .
               '&mch_billno=' . $data['mch_billno'] .
               '&mch_id=' . $data['mch_id'] .
               '&nonce_str=' . $data['nonce_str'] .
               '&re_openid=' . $data['re_openid'] .
               '&remark=' . $data['remark'] .
               '&send_name=' . $data['send_name'] .
               '&total_amount=' . $data['total_amount'] .
               '&total_num=' . $data['total_num'] .
               '&wishing=' . $data['wishing'] .
               '&wxappid=' . $data['wxappid'] .
               '&key=' . $this -> key;
        return strtoupper(md5($str));
    }

    public function getPaySign($data){

        $str = 'amount=' . $data['amount'] .
               '&check_name=' . $data['check_name'] .
               '&desc=' . $data['desc'] .
               '&mch_appid=' . $data['mch_appid'] .
               '&mchid=' . $data['mchid'] .
               '&nonce_str=' . $data['nonce_str'] .
               '&openid=' . $data['openid'] .
               '&partner_trade_no=' . $data['partner_trade_no'] .
               '&key=' . $this -> key;
        return strtoupper(md5($str));
    }


}