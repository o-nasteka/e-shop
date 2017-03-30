<option value="<?= $category['id']?>"
    <?php if($category['id'] == $this->model->category_id) echo 'selected' ?>
>
    <!-- $tab - var for 'select_product' tpl, use in admin for product/update (_form) menu (parent/child tab) -->
    <?= $tab . $category['name'] ?>
</option>

<?php if ( isset($category['childs']) ) : ?>
    <ul>
        <?= $this->getMenuHtml($category['childs'], $tab . '- ') ?>
    </ul>
<?php endif; ?>



