<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/21/17
 * Time: 11:44
 */

namespace app\controllers;


use yii\base\Controller;
use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends AppController{

    public function actionIndex(){
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
//        debug($hits);
        return $this->render('index', compact('hits'));
    }

    public function actionView($id){
        $id = Yii::$app->request->get('id');
        $products = Product::find()->where(['category_id' => $id])->all();
        return $this->render('view', compact('products'));
    }

}