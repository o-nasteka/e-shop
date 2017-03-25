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
        // Get Product ID
        $id = Yii::$app->request->get('id');
        // Get Product QTY
        $qty = (int)Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;

        // Get product from DB
        $product = Product::findOne($id);
        if(empty($product)) return false;

        // Start session
        $session = Yii::$app->session;
        $session->open();

        // Add to Cart
        $cart = new Cart();
        $cart->addToCart($product, $qty);

//        debug($session['cart']);
//        debug($session['cart.qty']);
//        debug($session['cart.sum']);

        // if Ajax disable
        if ( !Yii::$app->request->isAjax ){
            return $this->redirect(Yii::$app->request->referrer);
        }

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }

    // Clear Cart => Delete all Items in Cart, button "Clear Cart"
    public function actionClear(){
        // Open session
        $session = Yii::$app->session;
        $session->open();
        // Remove Data from Session
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    // Delete 1pc Item from Cart
    public function actionDelItem(){
        // Get Product ID
        $id = Yii::$app->request->get('id');
        // Open session
        $session = Yii::$app->session;
        $session->open();
        // New Cart Model
        $cart = new Cart();
        // Call to reCalc method
        $cart->reCalc($id);

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));

    }

    // Show cart => Button Cart in Top Menu
    public function actionShow(){
        // Open session
        $session = Yii::$app->session;
        $session->open();

        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView(){
        return $this->render('view');
    }

}