<?php
include '../nav_menu.php';
?>
<script>
tinymce.init({
    selector:'#tiny',
    plugins: 'code bbcode image',
    bbcode_dialect: 'punbb',
    toolbar: 'code image',
    formats: {
    // Changes the default format for h1 to have a class of heading
    h1: { block: 'h1', classes: 'heading' }
    },
    });
</script>
<div class="center" style="margin: 0 auto; width: 90%; text-align: center;" >
<h1>Tiny Editor</h1>
<textarea name="tiny" id="tiny" cols="30" rows="10"></textarea>
</div>
</body>