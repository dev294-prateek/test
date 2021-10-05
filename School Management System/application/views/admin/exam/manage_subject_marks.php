<h1 class="page-title">Manage Subject Marks </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('subject_marks/<?php echo $allowed_class['id'];?>')" ><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->

<div class="guardian">
    <!---------------------------->
    <div class="col-sm-8 col-sm-offset-2" >
        <div class="panel panel-success" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="entypo-plus-circled"></i>
                    Detail
                </div>
            </div>
            <div class="panel-body">
                <h4 class="page-title" >Class : <?php $class= $this->admin_model->class_by_id($allowed_class['class_id']); echo $class['name'] ?></h4>
                <h4 class="page-title" >Section : <?php $section= $this->admin_model->section_by_id($allowed_class['section_id']); echo $section['name']; ?></h4>
            </div>
        </div>

    <!---------------------------->
    <table id="example" >
        <thead>
        <tr><th style="width:20px">Sn</th><th >Subjects</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php $sn=1;foreach ( $section_subject as $row) { ?>

            <tr>
                <td style="width: 10%"><?php echo $sn++; ?></td>
                <td  ><?php $x=$this->admin_model->list_subjects_by_id($row['subject_id']);print_r($x['name']); ?></td>
                <td><button class="btn btn-success">Manage</button></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
</div>
<!--=====================================-->
</div>

<!--=====================================-->
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

