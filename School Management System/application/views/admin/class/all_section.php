
<h1 class="page-title"> <?php echo ($title);?> </h1>
<h6 class="cent-refresh"><a class="gold-bt" onclick="loadview('all_section')"><i class="entypo-arrows-ccw"></i> Page Refresh</a></h6>
<hr>
<!--=====================================-->
<?php //print_r($all_class);?>
<div class="guardian">

</div>
<!--=====================================-->
<div class="col-sm-12  style="overflow-x:auto;">
<table id="example"  >
    <thead>
    <tr><th style="width: 20px"> S Id </th><th style="width: 20px"> C Id </th><th style="width: 50px" >Class </th><th style="width: 50px" >Section</th><th>Class Teacher</th>
        <?php if($flag=='section'){?>
        <th>Medium</th><th>Syllabus</th><th>Compulsory Sub</th><th>Optional Sub</th><th>Required Sub</th>
        <?php } ?>
        <th>Status</th><th>Action</th></tr>
    </thead>
    <tbody>
    <?php foreach ( $all_section as $row) { ?>
        <tr>
            <td style="width: 50px" ><?php  echo $row['section_id']?></td>
           <td style="width: 50px" ><?php  echo $row['class_id']?></td>
           <td style="width: 20px" ><?php $x=$this->admin_model->class_by_id($row['class_id']); echo $x['name']?></td>

            <td style="width: 50px" ><?php echo $row['name']?></td>
           <td><?php $teach=$this->admin_model->teacher_name($row['teacher_id']); print_r($teach);?></td>
            <?php if($flag=='section'){?>
           <td><span class="badge"><?php echo $row['medium']?></span></td>
           <td> <?php if($row['syllabus']){ ?><a class="label label-sm btn-green" href="<?php echo base_url();?>/uploads/<?php echo $row['syllabus']?>">Syllabus</a> <?php } ?></td>
            <td><?php echo $row['s_compulsory']; ?></td>
            <td><?php echo $row['s_optional']; ?></td>
            <td><?php echo $row['s_required']; ?></td>
            <?php } ?>
            <td><?php if($row['status']==1){ ?>
                    <span class="label label-sm btn-green" onclick="loadview('edit_section/<?php echo $row['section_id']; ?>')"><i class="entypo-star-empty"></i> Active</span>
                <?php }else{ ?>
                    <span class="label label-sm btn-red" onclick="loadview('edit_section/<?php echo $row['section_id']; ?>')"><i class="entypo-star"></i> Inactive</span>
                <?php } ?>
            </td>

            <td>
<!---->
                <div class="btn-group">
                    <button type="button" class="btn btn-green dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-left" role="menu">
                        <?php if($flag=='section'){?>
                        <li><a   onclick="loadview('edit_section/<?php echo $row['section_id']; ?>')"><i class="entypo-pencil"></i>  Edit </a> </li>
                        <li><a  onclick="loadview('section_subject/<?php echo $row["section_id"];?>')"><i class="entypo-doc-text-inv"></i> Subjects</a></li>
                        <li><a  onclick="loadview('section_syllabus/<?php echo $row["section_id"];?>')"><i class="entypo-doc-text-inv"></i>Syllabus</a></li>
                        <?php }?>
                        <?php if($flag=='fee'){?>
                        <li><a  onclick="loadview('section_fee/<?php echo $row["section_id"];?>')"><i class="entypo-doc-text-inv"></i> Fee</a></li>
                        <?php }?>
                    </ul>
                </div>
<!---->

            </td>

        </tr>
    <?php }?>
    </tbody>
</table>
</div>
<!--=====================================-->


<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


