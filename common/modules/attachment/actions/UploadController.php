<?php
/**
 * Created by PhpStorm.
 * User: yoyo
 * Date: 18/12/16
 * Time: 上午1:46
 */

namespace common\modules\attachment\actions;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class UploadController extends Controller
{
    public $enableCsrfValidation = false;

    public function actions()
    {
        return [
            'redactor-files-get' => [
                'class' => GetAction::className(),
                'type' => 'files',
            ],
            'redactor-image-upload' => [
                // redactor编辑器默认是否有水印，手动配置
                'class' => UploadAction::className(),
                'path' => date('Ymd')."/",//在系统设置里面的图片上传目录后面再加一个按时间为文件夹
//                '_water' => 'true', //是否需要水印，true or false，string型
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'filelink' => $result['files'][0]['url']
                    ] : [
                        'error' => $result['files'][0]['error']
                    ];
                }
            ],
            'redactor-images-get' => [
                'class' => GetAction::className(),
                'type' => 'images',
            ],
            'redactor-file-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd')."/",
                'uploadOnlyImage' => false,
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'filelink' => $result['files'][0]['url'],
                        'filename' => $result['files'][0]['filename']
                    ] : [
                        'error' => $result['files'][0]['error']
                    ];
                }
            ],
//            'avatar-upload' => [
//                'class' => UploadAction::className(),
//                'path' => 'avatar/' . Yii::$app->user->id,
//                'validatorOptions' => ['minWidth' => 100, 'minHeight' => 100, 'underWidth' => '图片宽高不要小于100x100', 'underHeight' => '图片宽高不要小于100x100']
//            ],
            'file-upload' => [
                // 单文件上传
                'class' => UploadAction::className(),
                'path' => date('Ymd')."/",//在系统设置里面的图片上传目录后面再加一个按时间为文件夹
                'uploadOnlyImage' => false,
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'errcode' => 0,
                        'errmsg' => 'ok',
                        'data' => $result['files'][0]
                    ] : [
                        'errcode' => 1,
                        'errmsg' => $result['files'][0]['error']
                    ];
                }
            ],
            'files-upload' => [
                // 多文件上传
                'class' => UploadAction::className(),
                'path' => date('Ymd')."/",
                'multiple' => true, //多文件
                'uploadOnlyImage' => false,
            ],
            'image-upload' => [
                // 单文件上传
                'class' => UploadAction::className(),
                'path' => date('Ymd')."/",
                'callback' => function($result) {
                    return !isset($result['files'][0]['error']) ? [
                        'errcode' => 0,
                        'errmsg' => 'ok',
                        'data' => $result['files'][0]
                    ] : [
                        'errcode' => 1,
                        'errmsg' => $result['files'][0]['error']
                    ];
                }
            ],
            'images-upload' => [
                'class' => UploadAction::className(),
                'path' => date('Ymd')."/",
                'multiple' => true,//多图
            ],
//            'backend-files-upload' => [
//                'class' => UploadAction::className(),
//                'path' => date('Ymd'),
//                'multiple' => true,
//                'uploadOnlyImage' => false,
//                'itemCallback' => function ($result) {
//                    $result['updateUrl'] = Url::to(['/attachment/update', 'id' => $result['id']]);
//                    return $result;
//                }
//            ],
//            'md-image-upload' => [
//                'class' => UploadAction::className(),
//                'path' => date('Ymd'),
//                'callback' => function($result) {
//                    return !isset($result['files'][0]['error']) ? [
//                        'success' => 1,
//                        'url' => $result['files'][0]['url']
//                    ] : [
//                        'success' => 0,
//                        'message' => $result['files'][0]['error']
//                    ];
//                }
//            ],
//            'im-image-upload' => [
//                'class' => UploadAction::className(),
//                'path' => date('Ymd'),
//                'callback' => function($result) {
//                    return !isset($result['files'][0]['error']) ? [
//                        'code' => 0,
//                        'msg' => '',
//                        'data' => [
//                            'src' => $result['files'][0]['url']
//                        ]
//                    ] : [
//                        'code' => 0,
//                        'msg' => $result['files'][0]['error'],
//                        'data' => (object)[]
//                    ];
//                }
//            ],
//            'im-file-upload' => [
//                'class' => UploadAction::className(),
//                'path' => date('Ymd'),
//                'uploadOnlyImage' => false,
//                'callback' => function($result) {
//                    return !isset($result['files'][0]['error']) ? [
//                        'code' => 0,
//                        'msg' => '',
//                        'data' => [
//                            'src' => $result['files'][0]['url'],
//                            'name' => $result['files'][0]['filename']
//                        ]
//                    ] : [
//                        'code' => 0,
//                        'msg' => $result['files'][0]['error'],
//                        'data' => (object)[]
//                    ];
//                }
//            ],
//            'ueditor' => [
//                'class' => 'common\modules\attachment\actions\UEditorAction',
//                'config' => [
//                ],
//            ],
//            'ueditor-catch' => [
//                'class' => CatchAction::className(),
//                'path' => date('Ymd'),
//            ],
//            'ueditor-image-upload' => [
//                'class' => UploadAction::className(),
//                'path' => date('Ymd'),
//                'uploadParam' => 'upfile',
//                'callback' => function($result) {
//                    return !isset($result['files'][0]['error']) ? [
//                        'state' => 'SUCCESS',
//                        'url' => $result['files'][0]['url'],
//                        'title' => $result['files'][0]['name'],
//                        'original' => $result['files'][0]['name'],
//                        'type' => $result['files'][0]['type'],
//                        'size' => $result['files'][0]['size'],
//                    ] : [
//                        'error' => $result['files'][0]['error']
//                    ];
//                }
//            ]
        ];
    }

    public function actionDelete($id)
    {
        //TODO AttachmentIndex里没有该attachment_id就可以把attachment删了
    }
}
