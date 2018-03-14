<div class="col-md-offset-4 col-md-6">
  <form id="searchAdmissionQuery" class="form-inline" action="<?php echo base_url();?>index.php?homemanage/search_query_list" method="post">
    <div class="form-group">
      <label for="email">Select Class: </label>
      <select name="class_id" id="" class="form-control">
        <?php $classs = $this->db->get('class')->result_array(); 
          foreach($classs as $k=>$class):
        ?>
        <option value="<?php echo $class['class_id'];?>"><?php echo $class['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<div id="queryListHolder"></div>

<script type="text/javascript">

$(document).ready(function() { 

    $('#searchAdmissionQuery').ajaxForm({ 
        beforeSend: function() {                
            $('#loading').show();
            $('#overlayDiv').show();
        },  
        success: function (data){
            var jData = JSON.parse(data);            
            toastr.success(jData.msg);  
            $( "#queryListHolder" ).html( jData.html );
            $('body,html').animate({scrollTop:0},800);
            $('#loading').fadeOut('slow');
            $('#overlayDiv').fadeOut('slow');                  
        }
    }); 

});

</script>


