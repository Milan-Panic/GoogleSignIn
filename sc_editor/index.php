<?php
include '../nav_menu.php';
?>
<div class="center" style="margin: 0 auto; width: 90%; text-align: center;" >
<h1>SC Editor</h1>
<textarea name="sc_editor" id="sc_editor" style="height:300px;width:1200px;"></textarea>
<script>
    sceditor.formats.bbcode.set('ul', {
    tags: {
        ul: null
    },
    breakStart: true,
    isInline: false,
    skipLastLineBreak: true,
    format: '[list]{0}[/list]',
    html: '<ul>{0}</ul>'
    });

    // sceditor.formats.bbcode.set('b', {
    // // tags: {
    // //     sung: null
    // // },
    // // allowsEmpty: false,
    // // isSelfClosing: false,
    // format: '[be]{0}[/be]',
    // html: '<be>{0}</be>',
    // quoteType: sceditor.BBCodeParser.QuoteType.auto
    // });
    // Replace the textarea #example with SCEditor
    var textarea = document.getElementById('sc_editor');
    sceditor.create(textarea, {
        format: 'bbcode',
        style: '../minified/themes/content/default.min.css'
    });
</script>
</div>
</body>