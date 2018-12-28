<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 2018/12/16
 * Time: 6:22 PM
 */

namespace common\modules\attachment\components;

use yii\base\Component;

class Storage extends Component
{

    /**
     * 根据据path获取网站链接，如果整合了七牛，阿里云等，这个方法需要改
     * @param $path
     * @return mixed
     */
    public function getUrl($path)
    {
        // 获取本地路径下的url地址
        return $this->getLocalUrl($path);
    }

    /**
     * 根据存储路径 + 配置项的 存储文件夹获取网页URL路径
     * @param $path
     * @return string
     */
    protected function getLocalUrl($path)
    {
        $newsUrl = \Yii::$app->config->get("newsurl");  //网站url
        $fileurl = \Yii::$app->config->get("fileurl");  //上传路径

        // 如果包含说明是onlyUrl上传的实体类
        $num = count(explode("http", $path)); //判断物理路径是否包含http的字符
        if ($num > 1) {
            // 如果包含了，就不再拼接链接
            return $path;
        }

        $fileurl = ltrim($fileurl, '/');
        $path = ltrim($path, '/');
        $url = $newsUrl . $fileurl . $path;
        return $url;
    }


    /**
     * 根据存储路径 + 配置项的 存储文件夹获取实际物理路径
     * @param $path
     * @return string
     */
    public function getPath($path){
        $fileurl = \Yii::$app->config->get("fileurl");  //上传路径
        $fileurl = ltrim($fileurl, '/'); //去掉左边的斜杠
        $path = ltrim($path, '/');  //去掉左边的斜杠
        return $path = \Yii::getAlias("@root") . "/web/" . $fileurl . $path; // 实际物理路径
    }


    /**
     * 根据存储路径 + 配置项的 存储文件夹 查询该文件是否存在磁盘上
     * @param $path
     * @return bool
     */
    public function has($path)
    {
        $path = $this->getPath($path); // 实际物理路径
        //文件是否存在
        if(file_exists($path)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 根据存储路径 + 配置项的 存储文件夹获取物理路径，再删除文件，调用该方法之前需要先调用has方法，查询该文件是否存在
     * @param $path
     */
    public function delete($path){
        $path = $this->getPath($path); // 实际物理路径
        @unlink($path);
    }
}