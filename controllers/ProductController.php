<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/23/17
 * Time: 13:17
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;


class ProductController extends AppController{

    public function actionView($id){
        //        Get ID from _GET ARRAY use reqest
//        $id = Yii::$app->request->get('id');
        // Get Product from DB
        $product = Product::findOne($id);
//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();

        //        Exception 404, if Category empty
        if(empty($product)){
            throw new \yii\web\HttpException(404, 'Такого товара нет');
        }

        // Hit Products
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
//        debug($hits);

        // Set Meta Tags, Title for View
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product', 'hits'));
    }

}