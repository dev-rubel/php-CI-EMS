<style>
    #rename-box, #create-dir-box, #move-file-box, #del-file-box, #del-folder-box, #upload-file-box {
        display: none;
    }
</style>
<div id="dir_wrapper">
   <?php 
    $oldPath = str_replace('/','_',$_SESSION['path']);
    $oldPath = $oldPath.'_';

    function get_all($key, $value, $oldPath)
    {
        $file = strpos($value, '.');
        if(is_numeric($file)){
            echo '<li><a href="#">'.$value.'</a>
            <a href="#" class="renameButton" data-value="'.$value.'" title="Rename"><i class="fa fa-eraser"></i></a>
            <a href="'.base_url().'index.php?admin/edit_file/'.$value.'" target="_blank" title="Edit"><i class="fa fa-pencil-square-o"></i></a>            
            </li>';
        }else{
            $path = $oldPath.$value;
            echo '<li><i class="fa fa-folder"></i> <a href="#" class="folder" data-path="'.$path.'">'.$value.'</a><ul></ul></li>';
        }
    }
   ?>

    <div class="row">   
        <br>
        <div class="create-dir-button">
            <div class="row">
                <div class="col-md-2" id="create-dir">
                    <h4><a href="#" id="create-dir-button"><i class="fa fa-plus"></i> Create Folder</a></h4>
                </div>
                <div class="col-md-2" id="upload-file">
                    <h4><a href="#" id="upload-file-button"><i class="fa fa-upload"></i> Upload File</a></h4>
                </div>
                <div class="col-md-2" id="move-file">
                    <h4><a href="#" id="move-file-button"><i class="fa fa-copy"></i> Move File</a></h4>
                </div>
                <div class="col-md-2" id="del-file">
                    <h4><a href="#" id="del-file-button"><i class="fa fa-minus-square"></i> Delete File</a></h4>
                </div>
                <div class="col-md-2" id="del-folder">
                    <h4><a href="#" id="del-folder-button"><i class="fa fa-trash"></i> Delete Folder</a></h4>
                </div>
            </div>
        </div> 
        <!-- create new folder/dir area -->
        <div id="upload-file-box">
            <br>
            <div class="row">
                <form id="ftpUploadFile" action="<?php echo base_url() .'index.php?admin/ftp_upload_file'; ?>" method="post" enctype="multipart/form-data">   
                    <div class="col-md-3">
                        <input type="file" name="file_name" class="form-control" id="upload-file-box-input" placeholder="Folder Name">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info">Upload</button>
                    </div>                    
                </form>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger cancle-operation">Cancle</a>
                </div>
            </div>
        </div>  
        <!-- create new folder/dir area -->
        <div id="create-dir-box">
            <br>
            <div class="row">
                <form id="ftpCreateDir" action="<?php echo base_url() .'index.php?admin/ftp_create_folder'; ?>" method="post">   
                    <div class="col-md-3">
                        <input type="text" name="folder_name" class="form-control" id="create-dir-box-input" placeholder="Folder Name">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info">Create</button>
                    </div>                    
                </form>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger cancle-operation">Cancle</a>
                </div>
            </div>
        </div>  
        <!-- move file area -->
        <div id="move-file-box">
            <br>
            <div class="row">
                <form id="ftpMoveFile" action="<?php echo base_url() .'index.php?admin/ftp_move_file'; ?>" method="post">   
                    <div class="col-md-3">
                        <input type="text" name="from_folder" class="form-control" id="move-file-from-box-input" placeholder="File name (This directory)">
                    </div>
                    <div class="col-md-1 text-center"><b>To</b></div>
                    <div class="col-md-3">
                        <input type="text" name="to_folder" class="form-control" id="move-file-to-box-input" placeholder="Move to file path">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info">Move</button>
                    </div>                    
                </form>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger cancle-operation">Cancle</a>
                </div>
            </div>
        </div>  
        <!-- file rename area -->
        <div id="rename-box">
            <br>
            <div class="row">
                <form id="ftpRename" action="<?php echo base_url() .'index.php?admin/ftp_rename_file'; ?>" method="post">   
                    <div class="col-md-3">
                        <input type="text" name="file_name" class="form-control" id="rename-box-input" placeholder="File Name">
                        <input type="hidden" name="pre_file_name" class="form-control" id="rename-box-input-pre">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info">Save</button>
                    </div>
                </form>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger cancle-operation">Cancle</a>
                </div>
            </div>
        </div>   
        <!-- delete file area -->
        <div id="del-file-box">
            <br>
            <div class="row">
                <form id="ftpdelFile" action="<?php echo base_url() .'index.php?admin/ftp_delete_file'; ?>" method="post">   
                    <div class="col-md-3">
                        <input type="text" name="file_name" class="form-control" id="del-file-box-input" placeholder="File Name (This Directory)">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info">Delete</button>
                    </div>
                </form>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger cancle-operation">Cancle</a>
                </div>
            </div>
        </div>   
        <!-- delete folder area -->
        <div id="del-folder-box">
            <br>
            <div class="row">
                <form id="ftpdelFolder" action="<?php echo base_url() .'index.php?admin/ftp_delete_folder'; ?>" method="post">   
                    <div class="col-md-3">
                        <input type="text" name="folder_name" class="form-control" id="del-folder-box-input" placeholder="Folder Name (This Directory)">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-info">Delete</button>
                    </div>
                </form>
                <div class="col-md-2">
                    <a href="#" class="btn btn-danger cancle-operation">Cancle</a>
                </div>
            </div>
        </div>   
        <br>
        <div class="col-md-12 well tree">    
            <ul id="tree">
                <?php 
                foreach($folder as $k=>$each){
                    if($each == '.' || $each == '..') {
                        if($each == '..') {
                            echo '<li><a href="#" class="folder" data-path="'.$oldPath.'prefolder">'.$each.'</a><ul></ul></li>';
                        }
                        if($each == '.') {
                            echo '<li><a href="#" class="folder" data-path="">'.$each.'</a><ul></ul></li>';
                        }                        
                    } else {
                        echo '<li>';
                            get_all($k,$each,$oldPath);
                        echo '</li>';
                    }} ?>
            </ul>
        </div>
    </div>
</div>

<script>
    // file rename form section
    $('#ftpRename').ajaxForm({
        beforeSend: function() {    
            $('#loadingProcess').show();
            $('#loadingProcess').text('Loading.....');    
        },  
        success: function (data){
            var jData = JSON.parse(data);
            $('#rename-box').hide();
            $('#rename-box-input').val('');
            $('#rename-box-input-pre').val('');
            if(jData.type) {
                $('#dir_wrapper').html(jData.html);
            }  
            $('#loadingProcess').text('!!.....'+jData.msg+'.....!!');
            // console.log(jData.msg);
        },
        complete: function() {            
            setTimeout(function(){
                $('#loadingProcess').hide();                  
            }, 2000);                     
        }
    }); 

    // file upload form section
    $('#ftpUploadFile').ajaxForm({
        beforeSend: function() {    
            $('#loadingProcess').show();
            $('#loadingProcess').text('Loading.....');    
        },  
        success: function (data){
            var jData = JSON.parse(data);
            $('#upload-file-box').hide();
            $('#upload-file-box-input').val('');
            if(jData.type) {
                $('#dir_wrapper').html(jData.html);
            }  
            $('#loadingProcess').text('!!.....'+jData.msg+'.....!!');
            // console.log(jData.msg);
        },
        complete: function() {            
            setTimeout(function(){
                $('#loadingProcess').hide();                  
            }, 2000);                     
        }
    }); 

    // create folder/dir form section
    $('#ftpCreateDir').ajaxForm({
        beforeSend: function() {    
            $('#loadingProcess').show();
            $('#loadingProcess').text('Loading.....');    
        },  
        success: function (data){
            var jData = JSON.parse(data);
            $('#create-dir-box').hide();
            $('#create-dir-box-input').val('');
            if(jData.type) {
                $('#dir_wrapper').html(jData.html);
            }            
            // console.log(jData.msg);
            $('#loadingProcess').text('!!.....'+jData.msg+'.....!!');
        },
        complete: function() {            
            cancleOperation();
            setTimeout(function(){
                $('#loadingProcess').hide();                  
            }, 2000);                     
        }
    }); 

    // delete folder/dir form section
    $('#ftpdelFolder').ajaxForm({
        beforeSend: function() {    
            $('#loadingProcess').show();
            $('#loadingProcess').text('Loading.....');    
        },  
        success: function (data){
            var jData = JSON.parse(data);
            $('#del-folder-box').hide();
            $('#del-folder-box-input').val('');
            if(jData.type) {
                $('#dir_wrapper').html(jData.html);
            }
            console.log(jData.msg);
            $('#loadingProcess').text('!!.....'+jData.msg+'.....!!');
        },
        complete: function() {            
            cancleOperation();
            setTimeout(function(){
                $('#loadingProcess').hide();                  
            }, 2000);                     
        }
    }); 

    // delete file form section
    $('#ftpdelFile').ajaxForm({
        beforeSend: function() {    
            $('#loadingProcess').show();
            $('#loadingProcess').text('Loading.....');    
        },  
        success: function (data){
            var jData = JSON.parse(data);
            $('#del-file-box').hide();
            $('#del-file-box-input').val('');
            if(jData.type) {
                $('#dir_wrapper').html(jData.html);
            }
            $('#loadingProcess').text('!!.....'+jData.msg+'.....!!');
        },
        complete: function() {            
            cancleOperation();
            setTimeout(function(){
                $('#loadingProcess').hide();                  
            }, 2000);                     
        }
    }); 
    
    function cancleOperation()
    {
        $('#create-dir-box').hide();
        $('#move-file-box').hide();
        $('#rename-box').hide();
        $('#del-file-box').hide();
        $('#del-folder-box').hide();
        $('#upload-file-box').hide();
        
        $('#create-dir').show();
        $('#move-file').show();
        $('#del-file').show();
        $('#del-folder').show();
        $('#upload-file').show();
    }

    $(function () {
        // rename file section
        $('.renameButton').on('click', function () {
            var Status = $(this).val($(this).attr("data-value"));
            var value = Status.context.dataset.value;  
            $('#rename-box').show();
            $('#rename-box-input').val(value);
            $('#rename-box-input-pre').val(value);
        });
        // upload file section
        $('#upload-file-button').on('click', function () {
            $('#create-dir').hide();
            $('#upload-file-box').show();            
            $('#move-file').hide();
            $('#del-file').hide();
            $('#del-folder').hide();
        });
        // create folder/dir section
        $('#create-dir-button').on('click', function () {
            $('#create-dir-box').show();
            $('#upload-file').hide();
            $('#move-file').hide();
            $('#del-file').hide();
            $('#del-folder').hide();
        });
        // move file section
        $('#move-file-button').on('click', function () {
            $('#create-dir').hide();
            $('#move-file-box').show();
            $('#upload-file').hide();
            $('#del-file').hide();
            $('#del-folder').hide();
        });
        // delete file section
        $('#del-file-button').on('click', function () {
            $('#create-dir').hide();
            $('#move-file').hide();
            $('#del-file-box').show();
            $('#upload-file').hide();
            $('#del-folder').hide();
        });
        // delete folder section
        $('#del-folder-button').on('click', function () {
            $('#create-dir').hide();
            $('#move-file').hide();
            $('#del-file').hide();
            $('#upload-file').hide();
            $('#del-folder-box').show();
        });
        // cancle operation section or reset section
        $('.cancle-operation').on('click', function () {
            cancleOperation();
        });
        $('.folder').on('click', function () {
            var Status = $(this).val($(this).attr("data-path"));
            var dirPath = Status.context.dataset.path;        
            
            $.ajax({
                url: '<?php echo base('admin','changeDir');?>',
                data: {'dir': dirPath},
                type: 'post',
                beforeSend: function() {
                    $('#loadingProcess').show();
                    $('#loadingProcess').text('Loading.....');
                },
                success: function(res) {
                    $('#dir_wrapper').html(res);
                },
                complete: function() {
                    $('#loadingProcess').text('!!.....Done.....!!');
                    setTimeout(function(){
                        $('#loadingProcess').hide();                  
                    }, 2000);                     
                }
            });
        });
    });
</script>