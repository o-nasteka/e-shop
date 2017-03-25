<?php
    use yii\helpers\Html;
?>
<?php if(!empty($session['cart'])) : ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Кол-во</th>
                <th>Цена</th>
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
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><span data-id="<?= $id ?>" class="glyphicon glyphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4">Итого: </td>
                    <td><?= $session['cart.qty']?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?= $session['cart.sum']?></td>
                </tr>
            </tbody>
        </table>
    </div>
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
