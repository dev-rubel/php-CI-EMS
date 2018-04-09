
<style>
	.tree, .tree ul {
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
</style>
<style type="text/css" media="screen">
    pre.ace_editor.ace-monokai.ace_dark {
        height: 400px;
        font-size: 16px;
    }
    i.fa.fa-pencil-square-o {
        color: forestgreen;
    }
    i.fa.fa-trash-o {
        color: red;
    }
</style>

   <?php 

   $this->load->helper('file');
   $folder = get_dir_file_info(APPPATH.'views/');

    function get_all($key, $value, $path='')
    {
        ksort($value);
        if(is_array($value)){
            $key = str_replace('\\','',$key);
            $path .= $key;            
            
            echo '<li><a href="#">'.$key.'</a>';
            echo '<ul>';
            foreach($value as $k=>$each){
                echo '<li>'.get_all($k, $each, $path).'</li>';
            }
            echo '</ul></li>';
        }else{
            $path = str_replace('/','',$path);
            $value2 = str_replace('/','',$value);
            echo '<li><a href="#">'.$value.'</a>
            <a href="'.base_url().'index.php?admin/edit_file/'.$path.'/'.$value2.'"><i class="fa fa-pencil-square-o"></i></a>
            <a href="'.base_url().'index.php?admin/delete_file/'.$path.'/'.$value2.'" onclick="return confirm("Are you sure you want to delete this file?");"><i class="fa fa-trash-o"></i></a>
            </li>';
        }
    }
   ?>

    <div class="row">
        <div class="col-md-12 well">
            <ul id="tree1">
                <?php foreach($map as $k=>$each){
                        echo '<li>';
                            get_all($k, $each);
                        echo '</li>';
                    } ?>
            </ul>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <?php 
                    
                    $file = file_get_contents(APPPATH.'views/test.ini', FILE_USE_INCLUDE_PATH); 
                    echo '<pre>';
                    // Parse without sections
                    $ini_array = parse_ini_file(APPPATH.'views/test.ini');
                    // print_r($ini_array);

                    // Parse with sections
                    $ini_array = parse_ini_file(APPPATH.'views/test.ini', true);
                    // print_r($ini_array);
            ?>
            <textarea name="" class="form-control" id="editor">
                <?php echo $file; ?>
            </textarea>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.6/theme-monokai.js"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/ini");
    </script>



<script>
	$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'fa fa-folder-open';
      var closedClass = 'fa fa-folder';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {

                if (this == e.target) {
                    
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews

$('#tree1').treed();

$('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});

</script>

