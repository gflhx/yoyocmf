<?php

namespace common\modules\attachment\models;

use common\modules\user\models\User;
use Yii;
use yii\base\InvalidConfigException;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%attachment}}".
 *
 * @property int $id
 * @property int $user_id 上传者用户id
 * @property string $name 文件名
 * @property string $oname 原文件名
 * @property string $title 图片标题
 * @property string $description 图片简介
 * @property string $path 文件存储路径
 * @property string $hash 文件哈希值
 * @property int $size 文件大小(KB)
 * @property string $type 文件类型
 * @property string $extension 文件后缀名
 * @property int $created_at
 * @property int $updated_at
 * @property string $url
 */
class Attachment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'size', 'created_at', 'updated_at'], 'integer'],
            [['path'], 'required'],
            [['name', 'oname', 'title', 'description', 'path', 'type', 'extension'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '上传者用户id',
            'name' => '文件名',
            'oname' => '原文件名',
            'title' => '图片标题',
            'description' => '图片简介',
            'path' => '文件存储路径',
            'hash' => '文件哈希值',
            'size' => '文件大小(KB)',
            'type' => '文件类型',
            'extension' => '文件后缀名',
            'created_at' => '上传时间',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    public function afterDelete()
    {
        parent::afterDelete();
        // 文件删了
        if (Yii::$app->storage->has($this->path)) {
            Yii::$app->storage->delete($this->path);
        }
    }

    /**
     * @param $hash
     * @return static|null
     */
    public static function findByHash($hash)
    {
        return static::findOne(['hash' => $hash]);
    }

    /**
     * @param $path
     * @param $file UploadedFile
     * @return Attachment|null|static
     * @throws \Exception
     */
    public static function uploadFromPost($path, $file)
    {
//        print_r($file);
        $hash = md5_file($file->tempName);
        $attachment = static::findByHash($hash);
        if (empty($attachment)) {

            $extension = $file->extension;
            $oname = substr($file->name, 0,strrpos($file->name, '.'));// 不带后缀名
            $filename = $hash. '.' . $extension;

//            p($path);
            $setFileUrl = Yii::$app->config->get("fileurl");
            $storagePath = Yii::getAlias("@root")."/web" .$setFileUrl . $path;
            self::DoMkdir($storagePath);
            $uploadRes = $file->saveAs($storagePath . $filename);

            if ($uploadRes) {
                $attachment = new static();
                $attachment->user_id = Yii::$app->user?Yii::$app->user->id:0;
                $attachment->path = $path.$filename;
                $attachment->name = $filename;
                $attachment->extension = $extension;
                $attachment->type = $file->type;
                $attachment->size = $file->size;
                $attachment->hash = $hash;
                $attachment->oname = $oname.".".$extension;
                $attachment->save();
                if($attachment->errors){
                    throw new \Exception(current($attachment->getFirstErrors()));
                }
            } else {
                throw new \Exception('上传失败');
            }
        }
        return $attachment;
    }

    //建立目录函数
    private static function DoMkdir($path)
    {
        //不存在则建立
        if (!file_exists($path)) {
            //安全模式
            $mk = @mkdir($path, 0777);
            @chmod($path, 0777);
            if(empty($mk))
            {
                throw new \Exception('创建'.$path.'目录失败');
            }
        }
        return true;
    }


    public function fields()
    {
        return array_merge(parent::fields(), [
            'url'
        ]);
    }


    /**
     * 根据path路径获取完整的图片路径
     * @return mixed
     */
    public function getUrl()
    {
        return Yii::$app->storage->getUrl($this->path);
    }

    /**
     * 获取上传人的信息
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
