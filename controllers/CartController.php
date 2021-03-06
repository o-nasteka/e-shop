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
use app\models\Order;
use app\models\OrderItems;
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
        // Open session
        $session = Yii::$app->session;
        $session->open();

        // Set Meta
        $this->setMeta('Корзина');

        // Create New Order
        $order = new Order();

        // Get Data from OrderForm
        if( $order->load(Yii::$app->request->post()) ){

            // Get Qty & Sum from session
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];

            // Save order
            if($order->save()){
                // Call to Save Order Items method
                $this->saveOrderItems($session['cart'], $order->id);

                Yii::$app->session->setFlash(
                    'success',
                    'Ваш заказ принят! Наш менеджер свяжется с Вами в ближайшее время.'
                );
                // Send E-Mail
                Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom(['o.nasteka@gmail.com' => 'E-Shopper'])
                    ->setTo($order->email)
                    ->setSubject('Заказ')
                    ->send();
                // To admin   adminEmail -> config/params.php
                Yii::$app->mailer->compose('order', ['session' => $session])
                    ->setFrom(['o.nasteka@gmail.com' => 'E-Shopper'])
                    ->setTo(Yii::$app->params['adminEmail'])
                    ->setSubject('Заказ')
                    ->send();

                // Clear cart
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                // Refresh page
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash(
                    'error',
                    'Ошибка оформления заказа!'
                );
            }
        }

        // Send to View, cart item($session) and new order($order)
        return $this->render('view', compact('session', 'order'));
    }

    // Save order Items; get $items(cart item), $order_id
    protected function saveOrderItems($items, $order_id){
        foreach($items as $id => $item){
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
        }
    }

}