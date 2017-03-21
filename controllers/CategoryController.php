<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/21/17
 * Time: 11:44
 */

namespace app\controllers;


use yii\base\Controller;

class CategoryController extends Controller{
    public function actionView(){
        return $this->render('view');
    }

}