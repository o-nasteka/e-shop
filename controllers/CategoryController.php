<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/21/17
 * Time: 11:44
 */

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController{

    // Main Page
    public function actionIndex(){
        // Hit Products
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        // Set Meta Tags, Title for Index
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }

    // Category -> Product Page
    public function actionView($id){
        //        Get ID from _GET ARRAY use reqest
//        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
//        Exception 404, if Category empty
        if(empty($category)){
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }

//        $products = Product::find()->where(['category_id' => $id])->all();

        // Pagination
        $query = Product::find()->where(['category_id' => $id]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        // End Pagination

        // Set Meta Tags, Title for View
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', 'category'));
    }

    // Action Search
    public function actionSearch(){
        // Get ID from _GET ARRAY use reqest
        $q = trim(Yii::$app->request->get('q'));

        // Set Meta Tags, Title for View
        $this->setMeta('E-SHOPPER | Поиск: ' . $q);

        // if q == false
        if(!$q) return $this->render('search', compact('q'));

        // Pagination
        $query = Product::find()->where(['like', 'name', $q]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false,
        ]);
        $products = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        // End Pagination

        return $this->render('search', compact('products', 'pages', 'q'));

    }

}