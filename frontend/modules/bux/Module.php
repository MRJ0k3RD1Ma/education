<?php

namespace frontend\modules\bux;

use yii\filters\AccessControl;
use Yii;
/**
 * bux module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\bux\controllers';
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
                            if(Yii::$app->user->identity->role_id == 3){
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
        Yii::$app->viewPath = "@frontend/modules/bux/views";
        // custom initialization code goes here
    }
}
