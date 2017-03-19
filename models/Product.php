<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/19/17
 * Time: 19:32
 */

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord{
    // table name
    public static function tableName(){
        return 'product';
    }
    //    relation with table `category`
    public function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}