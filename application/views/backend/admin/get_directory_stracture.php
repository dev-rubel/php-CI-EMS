
<style>
	.tree,  .tree ul {
        margin:0;
        padding:0;
        list-style:none
    }
    .tree ul {
        margin-left:1em;
        position:relative
    }
    .tree ul ul {
        margin-left:.5em
    }
    .tree ul:before {
        content:"";
        display:block;
        width:0;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        border-left:1px solid
    }
    .tree li {
        font-size: 18px;
        margin:0;
        padding:0 1em;
        line-height:2em;
        color:#369;
        font-weight:700;
        position:relative
    }
    .tree ul li:before {
        content:"";
        display:block;
        width:10px;
        height:0;
        border-top:1px solid;
        margin-top:-1px;
        position:absolute;
        top:1em;
        left:0
    }
    .tree ul li:last-child:before {
        background:#fff;
        height:auto;
        top:1em;
        bottom:0
    }
    .indicator {
        margin-right:5px;
    }
    .tree li a {
        text-decoration: none;
        color:#369;
    }
    .tree li button, .tree li button:active, .tree li button:focus {
        text-decoration: none;
        color:#369;
        border:none;
        background:transparent;
        margin:0px 0px 0px 0px;
        padding:0px 0px 0px 0px;
        outline: 0;
    }
    i.fa.fa-pencil-square-o {
        color: forestgreen;
    }
    i.fa.fa-trash-o {
        color: red;
    }
    .fa.fa-eraser {
        color: deepskyblue;
    }
</style>

<p id="loadingProcess"></p>    
<div id="dir_wrapper">
   <?php 
    $oldPath = str_replace('/','_',$_SESSION['path']);
    $oldPath = $oldPath.'_';

    function get_all($key, $value, $oldPath)
    {
        $file = strpos($value, '.');
        if(is_numeric($file)){
            echo '<li><a href="#">'.$value.'</a>
            <a href="'.base_url().'index.php?admin/edit_file/'.$value.'" target="_blank" title="Rename"><i class="fa fa-eraser"></i></a>
            <a href="'.base_url().'index.php?admin/edit_file/'.$value.'" target="_blank" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <a href="#" onclick="return confirm("Are you sure you want to delete this file?");" title="Delete"><i class="fa fa-trash-o"></i></a>
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