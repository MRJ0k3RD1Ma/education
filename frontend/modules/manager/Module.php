<?php

namespace frontend\modules\manager;

use yii\filters\AccessControl;
use Yii;
/**
 * manager module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\manager\controllers';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            if(Yii::$app->user->identity->role_id == 2){
                                return true;
                            }
                            header('Location: '.Yii::$app->urlManager->createUrl([Yii::$app->user->identity->role->url]));
                            exit;
                        }
                    ],

                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::$app->viewPath = "@frontend/modules/manager/views";
        // custom initialization code goes here
    }
}
