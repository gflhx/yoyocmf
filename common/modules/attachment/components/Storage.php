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
     * 根据物理路径获取网页路径
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

}