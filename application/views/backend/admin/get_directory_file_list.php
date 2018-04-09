<div id="dir_wrapper">
   <?php 
    $oldPath = str_replace('/','_',$_SESSION['path']);
    $oldPath = $oldPath.'_';

    function get_all($key, $value, $oldPath)
    {
        $file = strpos($value, '.');
        if(is_numeric($file)){
            echo '<li><a href="#">'.$value.'</a>
            <a href="'.base_url().'index.php?admin/edit_file/'.$value.'" target="_blank"><i class="fa fa-pencil-square-o"></i></a>
            <a href="#" onclick="return confirm("Are you sure you want to delete this file?");"><i class="fa fa-trash-o"></i></a>
            </li>';
        }else{
            $path = $oldPath.$value;
            echo '<li><i class="fa fa-folder"></i> <a href="#" class="folder" data-path="'.$path.'">'.$value.'</a><ul></ul></li>';
        }
    }
   ?>

    <div class="row">
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
    $(function () {
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