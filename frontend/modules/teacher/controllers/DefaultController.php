<?php

namespace frontend\modules\teacher\controllers;

use edofre\fullcalendar\models\Event;
use yii\web\Controller;

/**
 * Default controller for the `teacher` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $event = [];
        $ev = new Event();
        $ev->id = 1;
        $ev->title = 'Testing';
        $ev->start = date('Y-m-d\TH:i:s\Z');

        $event[] = $ev;
        $ev = new Event();
        $ev->id = 2;
        $ev->title = 'Testing';
        $ev->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 6am'));
        $event[] = $ev;
        $ev = new Event();
        $ev->id = 2;
        $ev->title = 'Testing';
        $ev->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 8am'));
        $event[] = $ev;
        $ev = new Event();
        $ev->id = 2;
        $ev->title = 'Testing';
        $ev->start = date('Y-m-d\TH:i:s\Z',strtotime('tomorrow 10am'));
        $event[] = $ev;
        return $this->render('index',[
            'event'=>$event
        ]);
    }
}
