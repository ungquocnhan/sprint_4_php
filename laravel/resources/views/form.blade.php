<form method="post" action="/route-demo">
<div>
    <input type="text" name="username" placeholder="Nhập username...">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
</div>
    <button type="submit">Submit</button>
</form>
