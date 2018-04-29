
<style type="text/css" media="screen">
    pre.ace_editor.ace-monokai.ace_dark {
        height: 400px;
        font-size: 16px;
    }
</style>
 <?php  $file = file_get_contents('ftp/'.$filename, FILE_USE_INCLUDE_PATH); ?>
    <div class="row">
        <div class="col-md-12">
            <p id="savingProcess"></p>           
            <textarea name="code" class="form-control" id="editor">
                <?php echo $file; ?>
            </textarea>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/theme-monokai.js"></script>
    <script>
        $('#savingProcess').hide();
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/php");
        editor.commands.addCommand({
            name: 'myCommand',
            bindKey: {win: 'Ctrl-M',  mac: 'Command-M'},
            exec: function(editor) {
                // console.log(editor.getValue());
                $.ajax({
                    url: "<?php echo base('admin','save_dir_file');?>",
                    type: "post",
                    data: {'value':editor.getValue()},
                    beforeSend: function() {
                        $('#savingProcess').show();
                        $('#savingProcess').text('Saving.....');
                    },
                    success: function (response) {
                        
                    },
                    complete: function() {
                        $('#savingProcess').text('!!.....Done.....!!');
                        setTimeout(function(){
                            $('#savingProcess').hide();                  
                        }, 2000);                     
                    }
                });
            },
            readOnly: true // false if this command should not apply in readOnly mode
        });
    </script>

