<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1>№ Заказа: <?= $model->id ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'updated_at',
            'qty',
            'sum',
            // 'status',
            [
                'attribute' => 'status',
                'value' => !$model->status
                        ? '<span class="text-danger">Не обработан</sapn>'
                        : '<span class="text-success">Обработан</sapn>',
                'format' => 'html',
            ],
            'name',
            'email:email',
            'phone',
            'address',
        ],
    ]) ?>

    <?php  $items = $model->getOrderItems();  ?>

    <div class="table-responsive">
        <table class="table table-striped table-bordered detail-view">
            <thead>
                <tr>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                </tr>
            </thead>
            <tbody>

            <?php   foreach($items as $item) :?>
                <tr>
                    <td><a href="<?= Url::to(['/product/view', 'id' => $item->product_id]) ?>"><?= $item['name'] ?></a></td>
                    <td><?= $item['qty_item'] ?> шт.</td>
                    <td>$ <?= $item['price'] ?></td>
                    <td>$ <?= $item['sum_item'] ?></td>
                </tr>
            <?php  endforeach;  ?>

            </tbody>
        </table>
    </div>

</div>
