<div class="col-md-2">
	<div class="form-group">
	<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('group');?></label>
		<select name="group_id" id="group_id" class="form-control">
            <option value="">Select Group</option>
			<?php 
				foreach($group_info as $row):
			?>
			<option value="<?php echo $row['group_id'];?>"><?php echo ucwords($row['name']);?></option>
			<?php endforeach;?>
		</select>
	</div>
</div>

<script type="text/javascript">

   
    $(document).ready(function () {

        // SelectBoxIt Dropdown replacement
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
            {
                var $this = $(el),
                        opts = {
                            showFirstOption: attrDefault($this, 'first-option', true),
                            'native': attrDefault($this, 'native', false),
                            defaultText: attrDefault($this, 'text', ''),
                        };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }

    });

</script>