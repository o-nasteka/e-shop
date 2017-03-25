<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "order_items".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $product_id
 * @property string $name
 * @property double $price
 * @property integer $qty
 * @property double $sum_item
 */
class OrderItems extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'name', 'price', 'qty', 'sum_item'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'sum_item'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    // Relation
    public function getOrder(){

        return $this->hasOne(Order::className(), ['id' => 'order_id']);

    }


}
