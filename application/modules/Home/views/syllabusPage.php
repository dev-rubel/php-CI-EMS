<style>
.container{padding: 0px;}
.widget-item.maxClass img {
    max-width: 700px;
}
</style>
<br>
<div class="container">

        <div class="panel-group" id="accordion">
        <?php $classes = $this->db->get('class')->result_array();
            if(!empty($classes)):foreach($classes as $key=>$class):
        ?>
            <div class="panel panel-info">
                <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $class['name']?>">
                    Class: <?php echo $class['name'] ?></a>
                </h4>
                </div>
                <div id="<?php echo $class['name']?>" class="panel-collapse collapse<?php echo $key==0?' in':'';?>">
                <?php $syllabuses = $this->db->get_where('academic_syllabus',['class_id'=>$class['class_id'],'year'=>$running_year])->result_array(); ?>
                <div class="panel-body">
                    <ul>
                    <?php if(!empty($syllabuses)): foreach($syllabuses as $key2=>$syllabus): ?>
                        <li>
                            <a href="<?php echo base_url();?>?Home/download_academic_syllabus/<?php echo $syllabus['academic_syllabus_code']; ?>" target="_blank"><?php echo $syllabus['title']; ?></a>
                        </li>
                    <?php endforeach; else: ?>
                        <li>No syllabus found.</li>
                    <?php endif; ?>
                    </ul>
                </div>
                </div>
            </div>
        <?php endforeach; else: ?>
                <h1 class="text-center">No Class Found</h1>
        <?php endif; ?>
        </div>

</div>
<br>