<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/24/17
 * Time: 14:41
 */

namespace app\models;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord{

    public function addToCart($product, $qty = 1){ // add min 1 qty product
        // Create Cart
        // if Product has in Cart, add + qty
        if(isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        } else { // if not in Cart, create
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
        // Total Qty
        // if isset Qty or if not
        $_SESSION['cart.qty'] = isset( $_SESSION['cart.qty'])
            ? $_SESSION['cart.qty'] + $qty
            : $qty;
        // Total Sum
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum'])
            ? $_SESSION['cart.sum'] + $qty * $product->price
            : $qty * $product->price;

    }

    // reCalc after delete 1pcs Item in Cart
    public function reCalc($id){
        // if Product ID has not in Cart
        if (!isset($_SESSION['cart'][$id])) return false;

        // Get Qty Delete Item & sum Delete Item
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];

        // Set new Qty & Sum in Cart after Delete 1pcs Item
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;

        // Delete Product from Cart
        unset($_SESSION['cart'][$id]);
    }

}