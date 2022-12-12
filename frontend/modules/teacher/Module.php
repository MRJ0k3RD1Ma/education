<?php

namespace frontend\modules\teacher;

use yii\filters\AccessControl;
use Yii;
/**
 * teacher module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\teacher\controllers';
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
                            if(Yii::$app->user->identity->role_id == 1){
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
        Yii::$app->viewPath = "@frontend/modules/teacher/views";
        // custom initialization code goes here
    }
}
