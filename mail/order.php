<div class="table-responsive">
    <table style="width: 100%; border: 1px solid #ddd; border-collapse: collapse;">
        <thead>
        <tr style="background: #f9f9f9;">
            <th style="padding: 8px; border: 1px solid #ddd;">Наименование</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Кол-во</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
            <th style="padding: 8px; border: 1px solid #ddd;">Сумма</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($session['cart'] as $id => $item) :?>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['name'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $item['qty'] ?> шт.</td>
                <td style="padding: 8px; border: 1px solid #ddd;">$ <?= $item['price'] ?></td>
                <td style="padding: 8px; border: 1px solid #ddd;">$ <?= $item['price'] * $item['qty'] ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">Итого: </td>
            <td> <?= $session['cart.qty']?> шт.</td>
        </tr>
        <tr>
            <td colspan="3" style="padding: 8px; border: 1px solid #ddd;">На сумму: </td>
            <td> $ <?= $session['cart.sum']?></td>
        </tr>
        </tbody>
    </table>
</div>


