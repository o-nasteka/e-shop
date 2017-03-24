<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/24/17
 * Time: 14:14
 */

namespace app\controllers;
use app\models\Product;
use app\models\Cart;
use Yii;

/*

Array
(
    [1] => Array
    (
        [qty] => QTY
        [name] => NAME
        [price] => PRICE
        [img] => IMG
    )
    [10] => Array
    (
        [qty] => QTY
        [name] => NAME
        [price] => PRICE
        [img] => IMG
    )
)
    [qty] => QTY,
    [sum] => SUM
);


*/

class CartController extends AppController {

    // Add to Cart action
    public function actionAdd(){
        $id = Yii::$app->request->get('id');

        // Get product from DB
        $product = Product::findOne($id);
        if(empty($product)) return false;

        // Start session
        $session = Yii::$app->session;
        $session->open();

        // Add to Cart
        $cart = new Cart();
        $cart->addToCart($product);

    }

}