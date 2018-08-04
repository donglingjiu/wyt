<?php
namespace app\index\controller;

class Index
{
    public function indexBak()
    {
        
    	$signature = $_GET['signature'] ;
    	$timestamp = $_GET['timestamp'] ;
    	$nonce = $_GET['nonce'] ;
    	$echostr = $_GET['echostr'] ;

    	$token = 'wangyueting' ;

    	$arr = array($token,$timestamp,$nonce) ;
    	//自然排序
    	sort($arr) ;
    	//拆成字符串 加密
    	$str = sha1(implode($arr)) ;
    	/*
			第一次配置个人服务器时候 为新服务器会传递参数$echostr
			与个人服务器建立连接之后  不会传递该参数
    	*/
    	if($str == $signature && $echostr) {
    		echo $echostr ;
    		die ;
    	}else {
    		$this->subscribeMsg() ;
    	}

    }

    /*
		关注 |取消关注 
		subscribe|unsubscribe
    */
	public function index() 
	{
		//获取用户信息 xml数据包
		$data = file_get_contents("php://input") ;
		file_put_contents('data.txt', $data) ;
		//xml格式数据转换成对象
		$postObj = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA) ;
		$toUser = $postObj->FromUserName ;
		$fromUser = $postObj->ToUserName ;
		$time = time() ;
		//如果消息类型是  event  (取消)关注事件
		if(strtolower($postObj->MsgType) == 'event') {
			//如果 事件类型，subscribe(订阅)  推送文本信息
			if(strtolower($postObj->Event) == 'subscribe') {

				$type = 'text' ;
				$content = "欢迎加入XXX，从今天起，我们将携手共进，建议添加个人微信：dongling_shisan，经常会有霸王餐、试吃券、吃货聚会等福利哦！ 回复 '吃货' 查看热门菜品, 回复资料 跳转到CSDN查看相关资料,回复 '照片'查看环境 回复图文|多图文看景 回复 南山南|还魂们看片... " ;
				//拼接 响应数据包模板 %s字符串类型占位 sprintf()
				$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
				//变量 依次替换字符串类型%s占位
				$info = sprintf($template,$toUser,$fromUser,$time,$type,$content) ;
				echo $info ;

			}else{
				$type = 'text' ;
				$content = "世事如棋 乾坤莫测 笑尽英雄啊" ;
				//拼接 响应数据包模板 %s字符串类型占位 sprintf()
				$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
				//变量 依次替换字符串类型%s占位
				$info = sprintf($template,$toUser,$fromUser,$time,$type,$content) ;
				echo $info ;
			}
		}else if(strtolower($postObj->MsgType) == 'text'){
			$content = $postObj->Content ;//用户发送的内容 原样返回
			switch ($content) {
				case '吃货':
					$str = "猴头, 燕窝 ,鲨鱼翅" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$str) ;
					echo $info ;
					break;
				//带超链接的纯文本  点击文本跳转 
				case '资料':
					$str = '<a href="https://blog.csdn.net/donglingjiu/article/details/81014313">查看资料</a>' ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$str) ;
					echo $info ;
					break;	

				case '图文':
				/*
				<xml><ToUserName>< ![CDATA[toUser] ]></ToUserName><FromUserName>< ![CDATA[fromUser] ]></FromUserName><CreateTime>12345678</CreateTime><MsgType>< ![CDATA[news] ]></MsgType><ArticleCount>2</ArticleCount><Articles><item><Title>< ![CDATA[title1] ]></Title> <Description>< ![CDATA[description1] ]></Description><PicUrl>< ![CDATA[picurl] ]></PicUrl><Url>< ![CDATA[url] ]></Url></item><item><Title>< ![CDATA[title] ]></Title><Description>< ![CDATA[description] ]></Description><PicUrl>< ![CDATA[picurl] ]></PicUrl><Url>< ![CDATA[url] ]></Url></item></Articles></xml>
				*/
					$title1 = "XXX图文1" ;
					$description1 = "半神半圣亦半仙 全儒全道是全贤 脑中真书藏万卷 掌握文武半边天" ;
					//图片链接  网络地址
					$picurl = "https://img4.mukewang.com/szimg/5aaa55850001a3ef10800600.jpg" ;
					//点击图文跳转的链接
					$url = "http://www.baidu.com" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$title1,$description1,$picurl,$url) ;
					echo $info ;
					break ;
				case '多图文':
					$title1 = "XXX图文1" ;
					$description1 = "半神半圣亦半仙 全儒全道是全贤 脑中真书藏万卷 掌握文武半边天" ;
					//图片链接  网络地址
					$picurl = "https://img4.mukewang.com/szimg/5aaa55850001a3ef10800600.jpg" ;
					//点击图文跳转的链接
					$url = "http://www.baidu.com" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>5</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url) ;
					echo $info ;
					break ;

				default :
					$str = '远看山有色 近停水无声 春去花还在 人来鸟不惊 ';
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$str) ;
					echo $info ;
					break ;
			}
		}else{

			$str = '春眠不觉晓 '.'MediaId:'.$postObj->MediaId.' ThumbMediaId:'.$postObj->ThumbMediaId.' MsgId:'.$postObj->MsgId ;
			$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
			$info = sprintf($template,$toUser,$fromUser,$time,$str) ;
			echo $info ;
		}
	}

	/*
		cURL简单的采集
	*/
	public function httpcURL() 
	{	
		//初始化
		$curl = curl_init() ;
		//设置url
		$url = "https://www.imooc.com/" ;
		curl_setopt($curl, CURLOPT_URL, $url) ;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;//文件流形式返回
		//采集
		$output = curl_exec($curl) ;
		//关闭cURL
		curl_close($curl) ;
		//echo $output ;
		file_put_contents('data.html', $output) ;
	}

	/*
		cURL获取access_token
	*/
	public function getAccessToken() 
	{
		$appID = 'wx75f961dc55d8575d' ;
		$appSecret = '703a9246c5338656e013c0f57c95a142' ;
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appID."&secret=".$appSecret ;

		//初始化 cURL
		$curl = curl_init() ;
		//设置参数
		curl_setopt($curl, CURLOPT_URL, $url) ;
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true) ;
		//采集数据 
		$output = curl_exec($curl) ;
		//关闭
		curl_close($curl) ;

		if(curl_errno($curl)) {
			var_dump(curl_errno($curl)) ;
		}
		//采集回来的json格式转换成数组
		$arr = json_decode($output,true) ;
		dump($arr) ;
 	}

 	/*
		获取微信服务器IP地址  做安全性验证 
		防止非微信服务器请求
 	*/
	public function getWxServerIp() 
	{
		//上述获取的access_token
		$access_token = '12_pA2wc_Mi44MY7LFSZSHsmka5Yg8wWP_WSkEXyWEMW0NjumZkrtVJ-vq1WxJU5kZGAhvFe08NdcK6h07QgDMkslx9r6wO7d61E4RV0Q4kw6ARv0DAqiucmpMmVzXlJqiXp2oYRjo2ceISjqa2UPLfADAFAW' ;
		$url = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$access_token ;

		//初始化 cURL
		$ch = curl_init() ;
		//设置参数
		curl_setopt($ch, CURLOPT_URL, $url) ;
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true) ;
		//采集数据 
		$output = curl_exec($ch) ;
		//关闭
		curl_close($ch) ;

	/*	if(curl_errno($ch)) {
			var_dump(curl_errno($ch)) ;
		}*/
		//采集回来的json格式转换成数组
		$arr = json_decode($output,true) ;
		dump($arr) ;
		$str = '' ;
		foreach ($arr as $key => $value) {
			$str .= implode($value,'||') ;
		}
		dump($str) ;
		file_put_contents('data.txt', $str) ;
	}


	/*
		返回当前天气
	*/
	public function getWether() 
	{


		//初始化
		$curl = curl_init() ;
		//设置url
		// $url = "http://wthrcdn.etouch.cn/weather_mini?city=".urlencode("深圳") ;
		$url = "http://www.baidu.com" ;
		echo $url ;
		curl_setopt($curl, CURLOPT_URL, $url) ;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;//文件流形式返回
		//采集
		$output = curl_exec($curl) ;
		//关闭cURL
		curl_close($curl) ;

	
		// echo $output ;	
		$arr = json_decode($output,true) ;
		var_dump($arr) ;


	
	}
	
}
