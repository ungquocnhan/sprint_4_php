<h1>Upload file</h1>
<form action="<?php echo route('categories.file') ?>" method="post" enctype="multipart/form-data">
    <div>
        <!--        <input type="text" name="category_name" placeholder="Nhập tên chuyên mục..." value="--><?php //echo $old ?><!--">-->
        <input type="file" name="photo" placeholder="Nhập tên chuyên mục..." value="<?php echo old('category_name') ?>">
        <!--        <input type="hidden" name="_token" value="--><?php //echo csrf_token(); ?><!--">-->
    </div>
    <?php
    echo csrf_field();
    ?>
    <button type="submit">Upload</button>
</form>

