<?php
/**
 * Created by PhpStorm.
 * User: nasteka
 * Date: 3/19/17
 * Time: 19:36
 */

namespace app\components;

use yii\base\Widget;
use app\models\Category;
use Yii;


class MenuWidget extends Widget{

    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;
    public $model;

    public function init(){
        parent::init();
        if ( $this->tpl === null ){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        // get menu from cache
        // only for User frontend;  cache disable for admin panel
        if($this->tpl == 'menu.php'){
            $menu = Yii::$app->cache->get('menu');
            if($menu) return  $menu;
        }


//      if not, get menu from DB
//        indexBy('id') - make  'key' = 'id' in Array
//        get data from DB
        $this->data = Category::find()->indexBy('id')->asArray()->all();
//        Create Menu Tree
        $this->tree = $this->getTree();
//        Create Html Template for Menu
        $this->menuHtml = $this->getMenuHtml($this->tree);

//        set cache, write menu to cache
        if($this->tpl == 'menu.php'){
            Yii::$app->cache->set('menu', $this->menuHtml, 60);  // 60 = 1min
        }

        return $this->menuHtml;

    }

//    Get Category Tree
    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node){
            if (!$node['parent_id'])
                $tree[$id] = &$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
        }
        return $tree;
    }
    //  Create Html Template for Menu
    // $tab - var for 'select' tpl, use in admin for category/update menu (parent/child tab)
    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category, $tab);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}