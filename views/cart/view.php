<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="container" id="cart-order">
    <?php if(!empty($session['cart'])) : ?>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($session['cart'] as $id => $item) :?>
                    <tr>
                        <!-- Product Image -->
                        <td>
                            <?= Html::img("@web/images/products/{$item['img']}",
                                [
                                    'alt' => $item['name'],
                                    'height' => 50
                                ])
                            ?>
                        </td>
                        <!-- End Product Image -->
                        <td><a href="<?= Url::to(['product/view', 'id' => $id]) ?>"><?= $item['name'] ?></a></td>
                        <td><?= $item['qty'] ?> шт.</td>
                        <td>$ <?= $item['price'] ?></td>
                        <td>$ <?= $item['price'] * $item['qty'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5"><strong>Итого: </strong></td>
                    <td><strong><?= $session['cart.qty']?> шт.</strong></td>
                </tr>
                <tr>
                    <td colspan="5"><strong>На сумму: </strong></td>
                    <td><strong>$ <?= $session['cart.sum']?></strong></td>
                </tr>

                </tbody>
            </table>
        </div>
        <hr>
        <?php $form = ActiveForm::begin(); ?>
        <?= $form->field($order, 'name')?>
        <?= $form->field($order, 'email')?>
        <?= $form->field($order, 'phone')?>
        <?= $form->field($order, 'address')?>
        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-success'])?>
        <br><br>
        <?php $form = ActiveForm::end(); ?>
    <?php else : ?>
        <br>
        <br>
        <h4>
            В корзине покупок ничего нет! <br>
            Выберите понравившиеся товары и добавьте их в корзину.
        </h4>
        <br>
        <br>
    <?php endif; ?>

</div>
