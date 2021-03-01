<?php
include '../nav_menu.php';
?>
<div class="center" style="margin: 0 auto; width: 90%; text-align: center;" >
<h1>SC Editor</h1>
<form action='' method='POST'>
<textarea name="sc_editor" id="sc_editor" style="height:300px;width:1200px;"></textarea>
<script>
    /* primer za drag drop korisceno sa sajta: https://www.sceditor.com/posts/drag-drop-upload-demo/*/
    
    /**
     * Takes a file and uploads it to imgur.
     * 
     * @param {File} file
     * @return {Promise}
     */
    function imgUpload(file) {
        var form = new FormData();
        form.append('file', file);
        var url_from_php = '';
        $.ajax({  
            url:"upload.php",  
            method:"POST",  
            data:form,
            async: false, //depricated
            contentType:false,  
            cache: false,  
            processData: false,  
            success:function(data){
                url_from_php = data;
            }  
        });        
        let myPromise = new Promise(function(myResolve, myReject) {
            let x = 0;
            if (x == 0) {
                myResolve(url_from_php);
            } else {
                myReject(console.log('Error in url'));
            }
        });
        return myPromise;
    }
    var dragdropOptions = {
        // The allowed mime types that can be dropped on the editor
        allowedTypes: ['image/jpeg', 'image/png'],
        handleFile: function (file, createPlaceholder) {
            var placeholder = createPlaceholder();

            imgUpload(file).then(function (url) {
                // Replace the placeholder with the image HTML
                placeholder.insert('<img src=\''+url.trim()+'\'/>');
            }).catch(function () {
                // Error so remove the placeholder
                placeholder.cancel();

                alert('Problem uploading image to server.');
            });
        }
    };


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
        autofocus: true,
        plugins: 'dragdrop',
        dragdrop: dragdropOptions,
        style: '../minified/themes/content/default.min.css',
        resizeEnabled: false
    });
    
</script>
<button type="submit" name="submit2" class="btn btn-primary">Submit</button>
</div>
</form>
<div class="output">
    <?php if(isset($_POST['sc_editor'])){ 
        echo ForumCodeToHtml($_POST['sc_editor']);
    } ?>
</div>
</body>