<option value="<?= $category['id']?>"
    <?php if($category['id'] == $this->model->parent_id) echo 'selected' ?>
    <?php if($category['id'] == $this->model->id) echo 'disabled' ?>
    >
    <!-- $tab - var for 'select' tpl, use in admin for category/update menu (parent/child tab) -->
    <?= $tab . $category['name'] ?>
</option>

<?php if ( isset($category['childs']) ) : ?>
    <ul>
        <?= $this->getMenuHtml($category['childs'], $tab . '- ') ?>
    </ul>
<?php endif; ?>



