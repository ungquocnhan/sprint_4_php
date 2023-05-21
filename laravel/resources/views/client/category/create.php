<h1>Thêm chuyên mục</h1>
<form action="<?php echo route('categories.create') ?>" method="post">
    <div>
<!--        <input type="text" name="category_name" placeholder="Nhập tên chuyên mục..." value="--><?php //echo $old ?><!--">-->
        <input type="text" name="category_name" placeholder="Nhập tên chuyên mục..." value="<?php echo old('category_name') ?>">
<!--        <input type="hidden" name="_token" value="--><?php //echo csrf_token(); ?><!--">-->
    </div>
    <?php
    echo csrf_field();
    ?>
    <button type="submit">Submit</button>
</form>
