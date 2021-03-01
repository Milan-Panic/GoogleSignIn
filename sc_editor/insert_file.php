<?php
include '../nav_menu.php';
?>
<div class="center" style="margin: 0 auto; width: 90%; text-align: center;" >
<h1>SC Editor</h1>
<form action='' method='POST' enctype="multipart/form-data">
<!-- <script>
$(function() {
    $("#sc_editor").sceditor({
        toolbar: 'bold,italic,underline,strike,subscript,superscript|left,center,right,justify|font,size,color|bulletlist,orderedlist,indent,outdent|table,code,quote,quotename,spoiler|image,link,horizontalrule|youtube,date,time|ltr,rtl|maximize,source',
		format: 'bbcode',
        style: '/minified/themes/content/default.min.css',
        autofocus: true,
        resizeEnabled: false
    });
    window.sceditorInstance = $("#sc_editor").sceditor("instance");
});
</script> -->
<textarea name="sc_editor" id="sc_editor" style="height:300px;width:1200px;"></textarea>
<script>
    sceditor.command.set('quotename', {
	exec: function() {
        this.insert('[quote=author]This is an example quote.[/quote]');
	},
    tooltip: 'Insert the quote with author'    
    });

    sceditor.command.set('spoiler', {
	exec: function() {
        this.insert('[spoiler=ButtonText]This is an example "spoiler" text.[/spoiler]');
	},
    tooltip: 'To hide "spoiler" text'    
    });

    var textarea = document.getElementById('sc_editor');
    sceditor.create(textarea, {
        toolbar: 'bold,italic,underline,strike,subscript,superscript|left,center,right,justify|font,size,color|bulletlist,orderedlist,indent,outdent|table,code,quote,quotename,spoiler|image,link,horizontalrule|youtube,date,time|ltr,rtl|maximize,source',
        format: 'bbcode',
        style: '../minified/themes/content/default.min.css',
        autofocus: true,
        resizeEnabled: false
    });
    window.sceditorInstance = $("#sc_editor").sceditor("instance");
</script>
    <p><label>Image: <input type="file" name="media" id="media" /></label></p>
    <p><input type="submit" value="Upload" /></p>
<script>
    $(document).ready(function(){
        $(document).on('change', '#media', function(){
        var name = document.getElementById("media").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
        {
            alert("Invalid Image File");
        }
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("media").files[0]);
        var f = document.getElementById("media").files[0];
        var fsize = f.size||f.fileSize;
        if(fsize > 2000000)
        {
            alert("Image File Size is very big");
        }
        else
        {
        form_data.append("file", document.getElementById('media').files[0]);
        $.ajax({
                url:"upload_file.php",
                method:"POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data)
                {
                parent.window.sceditorInstance.insert(data);
                }
            });
        }
    });
});
</script>
<button type="submit" name="submit2" class="btn btn-primary">Submit</button>
</div>
</form>
<div class="output">
    <?php if(isset($_POST['submit2'])){ 
        echo ForumCodeToHtml($_POST['sc_editor']);
    } ?>
</div>
</body>