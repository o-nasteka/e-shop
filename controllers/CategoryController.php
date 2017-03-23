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
use yii\data\Pagination;

class CategoryController extends AppController{

    // Main Page
    public function actionIndex(){
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        // Set Meta Tags, Title for Index
        $this->setMeta('E-SHOPPER');
        return $this->render('index', compact('hits'));
    }

    // Category -> Product Page
    public function actionView($id){
        $id = Yii::$app->request->get('id');
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
        $category = Category::findOne($id);
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'pages', 'category'));
    }

}