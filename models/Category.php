<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/19/17
 * Time: 19:10
 */

namespace app\models;

use yii\db\ActiveRecord;

class Category extends ActiveRecord{
// table name
    public static function tableName(){
        return 'category';
    }

//    relation with table `product`
    public function getProducts(){
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

}