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
    	}/*else {
    		$this->indexBak() ;
    	}*/

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
				$content = "欢迎加入XXX，从今天起，我们将携手共进，建议添加个人微信：dongling_shisan，经常会有霸王餐、试吃券、吃货聚会等福利哦！ 回复 1 查看热门菜品, 回复 2 跳转到CSDN查看相关资料,回复 3 看片, 回复 5 看大片, ... " ;
				//拼接 响应数据包模板 %s字符串类型占位 sprintf()
				$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
				//变量 依次替换字符串类型%s占位
				$info = sprintf($template,$toUser,$fromUser,$time,$type,$content) ;
				echo $info ;

			}else if(strtolower($postObj->Event) == 'click'){
				if(strtolower($postObj->EventKey) == 'tuijiancai') {
					$title1 = "推荐菜品类" ;
					$description1 = "半神半圣亦半仙 全儒全道是全贤 脑中真书藏万卷 掌握文武半边天" ;
					//图片链接  网络地址
					$picurl = "https://img4.mukewang.com/szimg/5aaa55850001a3ef10800600.jpg" ;
					//点击图文跳转的链接
					$url = "http://www.baidu.com" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>1</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$title1,$description1,$picurl,$url) ;
					echo $info ;
				}
				if(strtolower($postObj->EventKey) == 'yuanchuangshuangwen1'){
					$title1 = "原创文章" ;
					$description1 = "半神半圣亦半仙 全儒全道是全贤 脑中真书藏万卷 掌握文武半边天" ;
					//图片链接  网络地址
					$picurl = "https://img4.mukewang.com/szimg/5aaa55850001a3ef10800600.jpg" ;
					//点击图文跳转的链接
					$url = "http://www.baidu.com" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>5</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url) ;
					echo $info ;
				}
				if(strtolower($postObj->EventKey) == 'yuanchuangshuangwen2'){
					$title1 = "原创文章" ;
					$description1 = "半神半圣亦半仙 全儒全道是全贤 脑中真书藏万卷 掌握文武半边天" ;
					//图片链接  网络地址
					$picurl = "https://img4.mukewang.com/szimg/5aaa55850001a3ef10800600.jpg" ;
					//点击图文跳转的链接
					$url = "http://www.baidu.com" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[news]]></MsgType><ArticleCount>5</ArticleCount><Articles><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item><item><Title><![CDATA[%s]]></Title><Description><![CDATA[%s]]></Description><PicUrl><![CDATA[%s]]></PicUrl><Url><![CDATA[%s]]></Url></item></Articles></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url,$title1,$description1,$picurl,$url) ;
					echo $info ;
				}
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
				case '1':
					$str = "猴头, 燕窝 ,鲨鱼翅" ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$str) ;
					echo $info ;
					break;
				//带超链接的纯文本  点击文本跳转 
				case '2':
					$str = '<a href="https://blog.csdn.net/donglingjiu/article/details/81014313">查看资料</a>' ;
					$template = "<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>" ;
					$info = sprintf($template,$toUser,$fromUser,$time,$str) ;
					echo $info ;
					break;	

				case '3':
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
				case '4':
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
		$appID = 'wxae6ea3e45f074997' ;
		$appSecret = '2cbafacadab5493a73144fd08a517f52' ;
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
		$url = "http://wthrcdn.etouch.cn/weather_mini?city=".urlencode("深圳") ;
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

	/*
		cURL可能是get|post
		$url 接口URL string
		$type 请求类型 string
		$res 返回数据类型 string 
		$arr post请求参数 string 
	*/
	public function http_curl($url,$type='get',$res='json',$arr='') 
	{
		//初始化
		$curl = curl_init() ;
		//设置curl参数
		curl_setopt($curl, CURLOPT_URL, $url) ;
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1) ;//文件流形式返回
		if($type == 'post') {
			curl_setopt($curl, CURLOPT_POST, true) ;
			curl_setopt($curl, CURLOPT_POSTFIELDS, $arr) ;
		}
		//采集
		$output = curl_exec($curl) ;
		//关闭cURL
		curl_close($curl) ;
		if($res == 'json') {
			/*if(curl_errno($curl)) {
				//请求失败 返回错误信息
				return curl_error($curl) ;
			}else{
				//请求成功  返回数组格式
				return json_decode($output,true) ;
			}*/
			return json_decode($output,true) ;
		}

	}


	/*
		将access_token存到session中  设置过期时间
	*/
	public function getSessionAccessToken() 
	{
		// 如果 session中存有 access_token 并且未超过有效期 使用session中的access_token
		if(session('access_token') && session('expire_time') > time()) {
			return  session('access_token') ;
		}else{
			//第一次获取 或者已经超时  重新获取access_token 
			$appID = 'wxae6ea3e45f074997' ;
			$appSecret = '2cbafacadab5493a73144fd08a517f52' ;
			//get请求方式
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appID."&secret=".$appSecret ;

			$res = $this->http_curl($url,'get','json') ;
			$access_token = $res['access_token'] ;
			//将获取到的access_token存到session 设置过期时间
			session('access_token',$access_token) ;
			session('expire_time',time() + 7000 ) ;
			// SESSION['access_token'] = $access_token ;
			// SESSION['expire_time'] = time() + 7000 ;
			return $access_token ;
		}
	}
	/*
		自定义菜单
	*/
	public function definedItem() 
	{
		header("content-type:text/html;charset=utf-8") ;
		//接口   post请求
		$access_token = $this->getSessionAccessToken() ;
		$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token ;
		//自定义菜单数据
		$data = array() ;
		$data["button"] = array(
			array(
				'name'=>"今天吃啥",
				'sub_button'=>array(
					array(
	 					"type"=>"click",
	          			"name"=>"推荐菜品",
	          			"key"=>"tuijiancai"
					) ,
					array(
						"type"=>"view",
	          			"name"=>"美团一下",
	          			"url"=>"http://i.meituan.com"
					) ,
					array(
						"type"=>"view",
	          			"name"=>"饿了吗来一份",
	          			"url"=>"https://h5.ele.me"
					) ,
					array(
						"type"=>"scancode_push",
	          			"name"=>"扫码推送",
	          			/*
							草料二维码 生成静态二维码  扫码之后跳转
							二维码 api
								http://qr.liantu.com/api.php?text=
								页面引用<img src="http://qr.liantu.com/api.php?text=x"/>进行引用
								text=可以是连接  http://www.baidu.com 
									可以是文字等
	          			*/
	          			"key"=>"saomatuisong"
					) 
				) 
			) ,
			array(
				'name'=>"原创专栏",
				'sub_button'=>array(
					array(
	 					"type"=>"scancode_waitmsg",
	          			"name"=>"扫码带提示",
	          			"key"=>"saomadaitishi"
					) ,
					array(
						"type"=>"pic_sysphoto",
	          			"name"=>"系统拍照发图",
	          			"key"=>"xitongpaizhaofatu"
					) ,
					array(
	 					"type"=>"click",
	          			"name"=>"原创爽文1",
	          			"key"=>"yuanchuangshuangwen1"
					) ,
					array(
	 					"type"=>"click",
	          			"name"=>"原创爽文2",
	          			"key"=>"yuanchuangshuangwen2"
					) ,
					array(
						"type"=>"pic_photo_or_album",
	          			"name"=>"拍照或者相册发图",
	          			"key"=>"paizhaohuozhexiangce"
					) 
				) 
			) ,
			array(
				'name'=>"联系我们",
				'sub_button'=>array(
					array(
	 					"type"=>"pic_weixin",
	          			"name"=>"微信相册发图",
	          			"key"=>"weixinxiangcefatu"
					) ,
					array(
						"type"=>"location_select",
	          			"name"=>"发送位置",
	          			"key"=>"fasongweizhi"
					) ,
				) 
			) 
		) ;
		//汉字不转义
		$postJson = json_encode($data,JSON_UNESCAPED_UNICODE) ;
		//cURL post请求
		$res = $this->http_curl($url,'post','json',$postJson) ;
		var_dump($res) ;

	}
	/*
		删除自定义菜单
	*/
	public function clearItem() 
	{
		//获取access_token
		$access_token = $this->getSessionAccessToken() ;
		//get请求
		$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$access_token  ;
		//cURL
		$res = $this->http_curl($url,'get','json') ;
		var_dump($res) ;


	}

	/*
		群发接口
	*/
	public function sendMsgAll() 
	{
		//获取全局access_token
		$access_token = $this->getSessionAccessToken() ;
		$url = "https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token=".$access_token ;
		//组装群发接口 array
		$data = array(
			'touser'=>'ordYy0e6ITMlHC6zJ9tT3zzj79iQ',//用户openID
			'text'=>array('content'=>"真仙非假仙 根基远无边") ,//文本内容
			'msgtype'=>'text'//消息类型
		) ; 
		// 将组装的 array转成json 汉字不转义
		$dataJson = json_encode($data,JSON_UNESCAPED_UNICODE) ;
		//cURL post请求
		$res = $this->http_curl($url,'post','json',$dataJson) ;
		dump($res) ;
	}
	
}
