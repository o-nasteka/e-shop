<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/21/17
 * Time: 13:25
 */

// App Controller

namespace app\controllers;
use yii\web\Controller;

class AppController extends Controller{

    // Set Title, Meta Taggs and Description for View
    protected function setMeta($title = null, $keywords = null, $description = null){
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}