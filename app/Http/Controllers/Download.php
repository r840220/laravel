<?php

namespace shopping_mall\Http\Controllers;

use Illuminate\Http\Request;

use shopping_mall\Http\Requests;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Download extends Controller
{
    private $yahoo_url = array(
        //array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152982935&img_only=0&depth=2&hits=500&hasmore=1&count=0', '2'),//電腦-桌電
        //array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152982922&img_only=0&depth=2&hits=500&hasmore=1&count=0', '3'),//電腦-筆電
        //array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=979311978&img_only=0&depth=2&hits=500&hasmore=1&count=0', '5'),//電腦周邊-滑鼠
        //array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152982959&img_only=0&depth=2&hits=500&hasmore=1&count=0', '6'),//電腦周邊-螢幕
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=
        
        
        
        
        
        
        &img_only=0&depth=3&hits=500&hasmore=1&count=0', '7'),//電腦周邊-音響
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983064&img_only=0&depth=3&hits=500&hasmore=1&count=0', '9'),//電腦零件-主機板
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983080&img_only=0&depth=3&hits=500&hasmore=1&count=0', '10'),//電腦零件-電源
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983068&img_only=0&depth=3&hits=500&hasmore=1&count=0', '11'),//電腦零件-CPU
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983285&img_only=0&depth=2&hits=500&hasmore=1&count=0', '13'),//家電用品-冷氣
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983277&img_only=0&depth=2&hits=500&hasmore=1&count=0', '14'),//家電用品-冰箱
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983405&img_only=0&depth=2&hits=500&hasmore=1&count=0', '15'),//家電用品-飲水機
        array('https://tw.mall.yahoo.com/ly_service/list/mid_leaf_item?catid=152983322&img_only=0&depth=2&hits=500&hasmore=1&count=0', '16'),//家電用品-洗衣機
    );

    private $type;

    public function __construct(){
        set_time_limit(0);
    }

    public function main(){
        header("Content-Type:text/html; charset=utf-8");
        foreach($this->yahoo_url as $type){
            $this->type = $type[1];
            $json = $this->curl($type[0]);
            $page = json_decode($json, true);
            $this->get_page($page['miditemlist']);
        }
    }

    public function curl($url){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }

    public function download_picture($url, $name){
        $data = $this->curl($url);

        $file = fopen('image/' . $name . '.jpg', 'w+');
        fputs($file, $data);
        fclose($file);
    }

    public function get_page($page){
        foreach($page as $data){
            $description = $this->get_item($data['link']);
            $id = $this->insert_db($data['alt'], $description, $data['price'],$this->type);
            $this->download_picture($data['imgsrc'], $id);
        }
    }

    public function get_item($url){
        $data = $this->curl($url);
        preg_match('/<p><span itemprop="description"[^>]*?>(.*?)<\/span><\/p>/si', $data ,$result);
        return $result[1];

    }

    public function create_folder(){

    }

    public function insert_db($title, $description, $price, $type){
        $item = array(
            'title' => $title,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            //'imagePath' => $imagePath,
            'description' => $description,
            'price' => $price,
            'type' => $type,
            'qty' => rand(10,100),
            'onsale' => rand(0,1)
        );
        $id = DB::table('products')->insertGetId($item);
        return $id;
    }


}