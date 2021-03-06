
<style>
    .hide-btn{
        display: none!important;
    }
    .error{
        border: 1px solid #F00;
    }
    .panel-heading{
        cursor: pointer;
    }

    .rooms-nav li a{
        background: #337ab7;
        color: #ffffff;
    }
    .rooms-nav li a:hover{
        background: #ffffff;
        color: #555;
    }
    .tab-content{
        border: 1px solid #ddd;
        padding: 5px;
    }

    .showBtn{
        cursor:pointer;
    }
    .thumbnailNonImage{
        display: block;
        width: 100%;
        height: 100%;
        min-width: 100px;
        min-height: 100px;
        background: #efefef;
        text-align: center;
        line-height: 90px;
    }
    .error{
        border: 1px solid #F00;
    }
    .glyphicon{
        cursor: pointer;
    }
    .defect-panel{
        font-size: 12px;
    }
    .thumbnail img{
        height: 100px;
    }
    #descriptionReadMore.collapse.in{
        display: inline;
    }
    a{
        cursor: pointer;
    }
    hr{
        margin: 5px;
    }

    .hasBottomBorder{
        border-bottom: 3px solid #000;
    }
    .panel-body{
        font-size: 12px!important;
    }
    input[type=checkbox],input[type=radio]{
        height: 20px;
    }
    .hide{
        display: none;
    }
    .modal{
        z-index: 99999999!important;
    }
</style>
<?php
echo form_open('');
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-primary form-horizontal" style="display:none;" >
        <div class="panel-heading" role="tab" data-toggle="collapse" data-parent="#accordion" data-target="#job_details" aria-expanded="true">
            <h4 class="panel-title">Job Details</h4>
        </div>
        <div id="job_details" data-menu-id="0" class="menu-panel panel-collapse collapse" role="tabpanel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <span style="font-size: 13px">Job Detail</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <label class="control-label col-sm-3">Job Name:</label>
                                    <div class="col-md-5">
                                        <?php echo form_dropdown('job_details[job_id]',$job_name,@$job_detail->job_id,'class="form-control input-sm required job_name"')?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="control-label">Date Received</label>
                                        <div class='input-group date' style="width: 100%;">
                                            <input type='text' name="job_details[date_receive]" class="form-control input-sm job-details required" data-type="date_entered" placeholder="dd/mm/yyyy hh:mm" readonly/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="control-label">Reference #</label>
                                        <input type="text" class="form-control input-sm job-details required" name="job_details[ref]" data-type="client_ref" value="<?php echo @$job_detail->ref ?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="control-label">Instruction Received</label>
                                        <?php echo form_dropdown('job_details[instruction_received]',$instruction_received,'','class="job-details form-control input-sm"');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <span style="font-size: 13px">Occupier Detail</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control input-sm job-details" data-type="owner" name="job_details[occupier_name]" value="<?php echo @$job_detail->occupier_name ?>" />
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label">Phone</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control input-sm job-details" data-type="owner_phone" name="job_details[occupier_phone_number]" value="<?php echo @$job_detail->occupier_phone_number ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label">Mobile</label>
                                        <input type="text" class="form-control input-sm job-details" data-type="owner_mobile" name="job_details[occupier_mobile]" value="<?php echo @$job_detail->occupier_mobile ?>" />
                                    </div>
                                    <div class="col-md-7">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control input-sm job-details" data-type="owner_email" name="job_details[occupier_email]" value="<?php echo @$job_detail->occupier_email ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <span style="font-size: 13px">Inspector Detail</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="control-label">Assigned to</label>
                                        <?php
                                        echo form_dropdown(
                                            'job_details[assigned_to]', $inspector, @$job_detail->assigned_to,
                                            'class="form-control input-sm required job-details" data-type="inspector_id"'
                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label">Date of Inspection</label>
                                        <div class='input-group date' style="width: 100%;">
                                            <input type='text' name="job_details[inspection_date]" class="form-control input-sm job-details required" data-type="inspection_time" placeholder="dd/mm/yyyy hh:mm" readonly/>
                                                    <span class="input-group-addon">
                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                    </span>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="control-label">Provide copies to</label>
                                        <input type="text" class="form-control input-sm job-details" name="job_details[provide_copies_to]" value="<?php echo @$job_detail->provide_copies_to ?>" />
                                    </div>
                                    <div class="col-md-7">
                                        <label class="control-label">Type of Inspection</label>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <select class="form-control input-sm inspection_range job-details" name="inspection_range">
                                                    <option value="1" <?php echo @$job_detail->inspection_range == 1 ? "selected" : "" ?>>Standard</option>
                                                    <option value="2" <?php echo @$job_detail->inspection_range == 2 ? "selected" : "" ?>>Detailed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7">
                                                <select class="form-control input-sm type_inspection job-details required" data-type="job_type_id" name="job_details[type_inspection]">
                                                    <option></option>
                                                    <?php
                                                    if(count($inspection_type) > 0){
                                                        foreach ($inspection_type as $v) {
                                                            echo '<option value="' . $v->id . '"' . (@$job_detail->type_inspection == $v->id ? ' selected' : '') . '>' . $v->inspection_type . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Purpose of the inspection</label>
                                        <textarea name="job_details[purpose_inspection]" class="form-control job-details input-sm" rows="6" style="resize: none;"><?php echo str_replace("<br />", "", @$job_detail->purpose_inspection) ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="panel panel-info">
                            <div class="panel-heading form-inline">
                                <span style="font-size: 13px">Property Detail</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="control-label">Property Owner</label>
                                        <input type="text" class="form-control input-sm job-details required" id="property_owner" data-type="owner" name="job_details[property_owner]" value="<?php echo @$job_detail->property_owner ?>" />
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label">Lot Number</label>
                                        <input type="text" class="form-control input-sm job-details" name="job_details[lot_number]" value="<?php echo @$job_detail->lot_number ?>" />
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label">DP Number</label>
                                        <input type="text" class="form-control input-sm job-details" name="job_details[dp_number]" value="<?php echo @$job_detail->dp_number ?>" />
                                    </div>
                                </div>
                                <label class="control-label">Address</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control input-sm property job-details" id="unit" name="job_details[property_unit]" placeholder="Unit/#" value="<?php echo @$job_detail->property_unit ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control input-sm property job-details" id="street_number" name="job_details[property_street_number]" placeholder="Street #" value="<?php echo @$job_detail->property_street_number ?>" />
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control input-sm property job-details required" id="street_name" data-type="address" name="job_details[property_street_name]" placeholder="Street Name" value="<?php echo @$job_detail->property_street_name ?>" />
                                    </div>
                                </div>
                                <label class="control-label">&nbsp;</label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control input-sm property job-details required" id="suburb" data-type="suburb" name="job_details[property_suburb]" placeholder="Suburb" value="<?php echo @$job_detail->property_suburb ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control input-sm property job-details required" id="city" data-type="city" name="job_details[property_city]" placeholder="Town/City" value="<?php echo @$job_detail->property_city ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control input-sm property job-details required" id="postal" data-type="zip_code" name="job_details[property_postal]" placeholder="Postal" value="<?php echo @$job_detail->property_postal ?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="control-label">Phone</label>
                                        <input type="text" class="form-control job-details input-sm" data-type="owner_phone" name="job_details[property_phone_number]" value="<?php echo @$job_detail->property_phone_number ?>" />
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label">Mobile</label>
                                        <input type="text" class="form-control job-details input-sm" data-type="owner_mobile" name="job_details[property_mobile]" value="<?php echo @$job_detail->property_mobile ?>" />
                                    </div>
                                    <div class="col-md-7">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control job-details input-sm" data-type="owner_email" name="job_details[property_email]" value="<?php echo @$job_detail->property_email ?>" />
                                    </div>
                                    <div class="col-md-9">
                                        <label class="control-label">Property Status</label>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <select class="form-control job-details input-sm property_status required" data-type="property_status_id" name="job_details[property_status]">
                                                    <option></option>
                                                    <?php
                                                    if(count($property_status) > 0){
                                                        foreach ($property_status as $v) {
                                                            echo '<option value="' . $v->id . '"' . (@$job_detail->property_status == $v->id ? ' selected' : '') . '>' . $v->property_status . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                    <option value="other" <?php echo @$job_detail->property_status == "other" ? 'selected' : '' ?>>Other (specify)</option>
                                                </select>
                                            </div>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control job-details input-sm property_status_other" name="job_details[property_status_other]" placeholder="If other" <?php
                                                echo @$job_detail->property_status == "other" ?
                                                    'value="' . @$job_detail->property_status_other . '"' :
                                                    'disabled';
                                                ?>/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="control-label">Pets</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="radio" name="job_details[pets]" class="job-details" value="1" <?php echo @$job_detail->pets == 1 ? 'checked' : '' ?>/>&nbsp;Yes
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio" name="job_details[pets]" class="job-details" value="0" <?php echo @$job_detail->pets == 0 ? 'checked' : '' ?>/>&nbsp;No
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-inline">
                                        <label class="control-label">Electricity</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="radio" name="job_details[electricity]" class="job-details" value="1" <?php echo @$job_detail->electricity == 1 ? 'checked' : '' ?>/>&nbsp;Connected
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" name="job_details[electricity]" class="job-details" value="0" <?php echo @$job_detail->electricity == 0 ? 'checked' : '' ?>/>&nbsp;Disconnected
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-inline">
                                        <label class="control-label">Water</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="radio" name="job_details[water]" class="job-details" value="1" <?php echo @$job_detail->water == 1 ? 'checked' : '' ?>/>&nbsp;Connected
                                            </div>
                                            <div class="col-md-6">
                                                <input type="radio" name="job_details[water]" class="job-details" value="0" <?php echo @$job_detail->water == 0 ? 'checked' : '' ?>/>&nbsp;Disconnected
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="control-label">Details of Property</label>
                                        <textarea name="job_details[details_property]" class="form-control input-sm job-details" rows="6" style="resize: none;"><?php echo str_replace("<br />", "", @$job_detail->details_property) ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label class="control-label">Orientation:</label>
                                        <?php
                                        echo form_dropdown('job_details[property_orientation]', $orientation, @$job_detail->property_orientation, 'class="form-control input-sm job-details"');
                                        ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <label class="control-label">&nbsp;</label>
                                        <input type="file" name="property_image" class="file propertyImage" accept="image/*" />
                                        <?php
                                        if(@$job_detail->property_image){
                                            echo '<br /><img src="' . base_url('report/' . $id . '/' . @$job_detail->property_image) . '" width="300" />';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- /.panel-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$field_groups = array();
if(count($menu) > 0){
    $ref = 0;
    foreach($menu as $m){
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" data-toggle="collapse" data-parent="#accordion" data-target="#<?php echo str_replace(" ", "_", $m->menu); ?>" aria-expanded="true">
                <h4 class="panel-title">
                    <?php echo $m->menu; ?>
                </h4>
            </div>
            <div id="<?php echo str_replace(" ", "_", $m->menu); ?>" data-menu-id="<?php echo $m->id ?>" class="menu-panel panel-collapse collapse" role="tabpanel">
                <div class="panel-body">
                    <?php
                    $menu_info = array_key_exists($m->id, $info) ? $info[$m->id] : array();
                    $menu_info_empty = count($menu_info) == 0;
                    if(in_array($m->id, array(1, 4, 5))){
                        $menu_info = array_shift($menu_info);
                        if(array_key_exists($m->id, $fields)){
                            echo '<div class="row">';
                            $f = $fields[$m->id];
                            foreach($f as $v){
                                $field_name = $v->field_name;
                                $default_value =
                                    $menu_info_empty ? '' :
                                        (array_key_exists($field_name, $menu_info) ? $menu_info->$field_name : '');
                                $_field = [];
                                if(count($defects) > 0){
                                    foreach($defects as $defect){
                                        $_field[] = $defect->field_id . '-' . $defect->room_id;
                                    }
                                }
                                hasMultiple($m, $v, $menu_info_empty, $default_value, $menu_info, '', $option, $field_name,0,$_field);

                                if($v->next_break){
                                    echo '</div><div class="row">';
                                }
                            }
                            echo "</div>";

                            if(in_array($m->id, array(4, 5))){
                                defectArea($m, $defects,0,array(),'',false);
                            }
                        }
                    }
                    else if(in_array($m->id, array(2))){
                        $room = $option[$m->id][2][1];
                        echo "<div class='col-xs-2'>";
                        echo form_dropdown(
                            'room_id[]', $room, null,
                            'class="room_name form-control input-sm selectpicker" multiple="multiple" title="Select Room"'
                        );
                        echo '</div><br><div style="margin-bottom: 5px!important;">&nbsp;</div>';

                        //region Create Tabs
                        echo '<ul class="rooms-nav nav nav-tabs" role="tablist">';
                        if(count($room) > 0){
                            $is = json_decode($interior_selected);
                            $ref = 0;
                            foreach($room as $key=>$xtr){
                                echo '<li role="presentation" id="' . $key . '" class="room_tab ' . (!in_array($key, $is) ? ' hidden' : '') . '">';
                                echo '<a href="#room_' . $key . '" role="tab" data-toggle="tab">' . $xtr . '</a>';
                                echo '</li>';
                                $ref ++;
                            }
                        }
                        echo '</ul>';
                        //endregion

                        echo '<div class="tab-content">';
                        if(count($room) > 0){
                            $ref = 0;
                            foreach($room as $key=>$xtr){
                                echo '<div role="tabpanel" class="tab-pane" id="room_' . $key . '">';
                                if(array_key_exists($m->id, $fields)){
                                    echo '<div class="row">';
                                    $f = $fields[$m->id];
                                    $_ref = count($f);
                                    foreach($f as $v){
                                        $rooms_id_json = json_decode($v->rooms_id_json);
                                        if(in_array($key, $rooms_id_json)){
                                            $room_menu_info = array_key_exists($key, $menu_info) ? $menu_info[$key] : array();
                                            $menu = '[' . $key . ']';
                                            $field_name = $v->field_name;
                                            $default_value =
                                                $menu_info_empty ? '' :
                                                    (array_key_exists($field_name, $room_menu_info) ? $room_menu_info->$field_name : '');
                                            //echo "<div class='col-md-4'>";
                                            //echo generateInputs($v, $v->per_option, $default_value, $menu_info, $menu, $m->id, $v->data_type_id, $v->option_id, $option, $field_name, $v->field_label, $v->field_dynamic, $v->label_header, $v->field_style);
                                            //echo "</div>";
                                            $_field = [];
                                            if(count($defects) > 0){
                                                foreach($defects as $defect){
                                                    $_field[] = $defect->field_id . '-' . $defect->room_id;
                                                }
                                            }
                                            hasMultiple($m, $v, 0, $default_value, $room_menu_info, $menu, $option, $field_name,$key,$_field);

                                            if($v->next_break){
                                                echo '</div>' . (!$v->field_group ? '<div class="col-md-12"><hr /></div>' : '') . '<div class="row">';
                                            }
                                        }
                                    }
                                    echo "</div>";
                                }
                                defectArea($m, $defects, $key, array(),'',false);

                                echo '</div>';
                                $ref ++;
                            }
                        }
                        echo '</div>';
                    }
                    else if(in_array($m->id, array(3))){
                        $menu_info = array_shift($menu_info);
                        $exteriors = array_key_exists($m->id, $option) ? $option[$m->id][17][4] : array();
                        if(count($exteriors) > 0){
                            echo '<div class="row">';
                            foreach($exteriors as $key=>$xtr){
                                ?>
                                <div class="col-md-4" style="margin-bottom: 10px;">
                                    <div class="panel panel-info">
                                        <div class="panel-heading" data-toggle="collapse" data-target="#<?php echo str_replace(" ", "_", $xtr); ?>" aria-expanded="true">
                                            <?php echo $xtr; ?>
                                        </div>
                                        <div id="<?php echo str_replace(" ", "_", $xtr); ?>" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <?php
                                                $_field = [];
                                                if(count($defects) > 0){
                                                    foreach($defects as $defect){
                                                        $_field[] = $defect->field_id . '-' . $defect->menu_id;
                                                    }
                                                }
                                                if(array_key_exists($m->id, $fields)){
                                                    $f = $fields[$m->id];
                                                    foreach($f as $v){
                                                        if($v->exterior_category_id == $key){
                                                            $field_name = $v->field_name;
                                                            $default_value =
                                                                $menu_info_empty ? '' :
                                                                    (array_key_exists($field_name, $menu_info) ? $menu_info->$field_name : '');
                                                            echo generateInputs($v, $v->per_option, $default_value, $menu_info, '', $m->id, $v->data_type_id, $v->option_id, $option, $field_name, $v->field_label, $v->field_dynamic, $v->label_header, $v->field_style);
                                                            if($v->has_defect_button){
                                                                $has_defect_noted = in_array($v->id . '-' . $m->id,$_field) ? '<span style="font-size: 10px;">[Y]</span>' : '';
                                                                ?>
                                                                <div class='col-md-1'>
                                                                    <label class='control-label'>&nbsp;</label>
                                                                    <div class="form-group">
                                                                        <button type="button" class="btn btn-danger defect-btn is-hide" disabled id="<?php echo $v->id . '-' . $m->id?>" data-value="<?php echo $m->id . '--0'?>"><span class="button-text">D</span><?php echo $has_defect_noted;?></button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="defect-container" style="display: none;" id="defect-<?php echo $v->id . '-' . $m->id?>">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <?php defectArea($m,array(),0, array(
                                                                                    'name' => 'exterior_category_id',
                                                                                    'value' => $exteriors,
                                                                                    'title' => 'Exterior Type'
                                                                                ), $v->id);?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            echo '</div>';
                        }
                        defectArea($m, $defects, 0,
                            array(
                                'name' => 'exterior_category_id',
                                'value' => $exteriors,
                                'title' => 'Exterior Type'
                            ),'',false
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        $ref ++;
    }
}
?>
<br />
    <?php
    if(!isset($_GET['view'])) {
        ?>
        <div class="form-group pull-right">
            <input type="hidden" name="time_start" value="<?php echo date('Y-m-d H:i:s') ?>"/>
            <input type="submit" name="submit" value="Save" class="btn btn-primary btn-sm saveBtn"/>
            <input type="reset" class="btn btn-danger btn-sm" value="Cancel"/>
        </div>
    <?php
    }
    ?>
</div>
<?php
echo form_close();

$field_group = array();
function generateInputs($field_value, $per_option, $default_value, $menu_info, $menu, $menu_id, $data_type_id, $option_id, $option, $fName, $field_label, $field_dynamic = '', $label_header = '', $field_style = '' ,$loop = NULL){
    $field_name = 'data[' . $menu_id . ']' . $menu . '[' . $fName . ']';
    $str = '';
    $genStr = '';
    $genStr .= '<div class="form-' . ($data_type_id == 3 ? 'inline' : 'group') . '">';
    $genStr .= $label_header ? '<label style="margin-top: 10px!important;">' . $label_header . '</label><hr style="margin: 10px!important;" />' : '';
    $genStr .= $field_label ? ('<label class="control-label">' . $field_label . ': &nbsp;' . '</label>') : '';

    if($option_id){
        if(array_key_exists($menu_id, $option)){
            if(array_key_exists($option_id, $option[$menu_id])){
                $opt = $option[$menu_id][$option_id];
                foreach($opt as $k=>$v){
                    if($k == 1){
                        $o = array('null' => '-');
                        $o += $v;
                        $str .= form_dropdown($field_name, $o, $default_value, 'class="form-control input-sm"');
                    }
                    else if($k == 2){
                        $dv = (array)json_decode($default_value);
                        $str .= '<div class="row"  style="font-size: 12px;">';
                        foreach($v as $key=>$val){
                            $is_checked = 0;
                            $is_val = "";
                            foreach($dv as $kk=>$vv){
                                if($kk == $key){
                                    $is_checked = 1;
                                    $is_val = $field_dynamic && $per_option ? (array)$vv : $vv;
                                    continue;
                                }
                            }
                            $str .= '<div class="col-md-9">';
                            $keyExist = $is_checked && is_array($is_val) ? array_key_exists('_count', $is_val) : 0;
                            $str .= '<div class="form-inline" style="margin-bottom: 5px;">';

                            $str .= $per_option ?
                                '<input type="number" class="form-control input-sm howMany" placeholder="How many?" value="' .
                                ($keyExist  ? count($is_val['_count']) : 0) .
                                '" style="width: 120px;">&nbsp;' : '';
                            $str .= '</div>';
                            $str .= $per_option ? '' : '<div class="form-inline"><input type="checkbox" class="checkbox input-sm checkBoxOption" ' . ($is_checked ? 'checked' : '') . '> ';

                            if($field_dynamic && $per_option){
                                $str .= '<div class="textOption hidden">';
                                $str .= generateFieldDynamic($field_value, 1, $per_option, $field_dynamic, $menu_id, $menu, $fName, $menu_info, $default_value, $key);
                                $str .= '</div>';

                                if($keyExist){
                                    $thisInfo = $is_val;
                                    foreach($thisInfo['_count'] as $count_key=>$count_val){
                                        $default_value = array(
                                            '_count' => $count_val,
                                            '_width' => $thisInfo['_width'][$count_key],
                                            '_height' => $thisInfo['_height'][$count_key],
                                            '_option' => array_key_exists('_option', $is_val) ? $is_val['_option'][$count_key] : 1
                                        );
                                        $str .= '<div class="form-inline workin fieldDynamicAreaExtra" style="margin-bottom: 5px;">';
                                        $str .= generateFieldDynamic($field_value, 0, $per_option, $field_dynamic, $menu_id, $menu, $fName, $menu_info, $default_value, $key, $count_key);
                                        $str .= '</div>';
                                    }
                                }
                            }
                            else{
                                $str .= '<input type="text" class="form-control input-sm textOption" style="width:40px" name="' . $field_name . '[' . $key . ']" value="' . ($is_checked ? $is_val : '') . '" ' . ($is_checked ? '' : '') . '>' . $val;
                                $str .= '</div>';
                            }
                            $str .= '</div>';
                        }
                        $str .= '</div>';
                    }
                    else if($k == 3){
                        $str .= '<div class="checkbox">';
                        foreach($v as $key=>$val){
                            $str .= '<label class="control-label"><input type="radio" name="' . $field_name . '" value="' . $key . '" ' . ($default_value == $key ? 'checked' : '') . '> ' . $val . '</label>';
                        }
                        $str .= '</div>';
                    }
                    else if($k == 5){
                        $str .= '<input type="number" class="form-control input-sm" name="' . $field_name . '" value="' . $default_value . '">';
                    }
                }
            }
        }
    }
    else{
        if(!$field_dynamic){
            if($data_type_id == 1){
                $str .= '<input type="text" class="form-control input-sm" name="' . $field_name . '" value="' . $default_value . '">';
            }
            else if($data_type_id == 2){
                $str .= '<input type="text" class="form-control input-sm" name="' . $field_name . '" value="' . $default_value . '">';
            }
            else if($data_type_id == 3){
                $str .=
                    '<div class="checkbox">
                        <input type="radio" name="' . $field_name . '" value="1" ' . ($default_value == 1 ? 'checked' : '') . '> Yes
                        <input type="radio" name="' . $field_name . '" value="0" ' . ($default_value == 0 ? 'checked' : '') . '> No
                    </div>';
            }
            else if($data_type_id == 5){
                $str .= '<input type="' . $data_type_id . '" ' . ($field_style != '' ? ('style="' . $field_style . '"') : '') . ' class="form-control input-sm" name="' . $field_name . '" value="' . $default_value . '">';
            }
            else if($data_type_id == 6){
                $str .= '<textarea ' . ($field_style != '' ? ('style="' . $field_style . '"') : '') . ' class="form-control input-sm" name="' . $field_name . '">' . $default_value . '</textarea>';
            }
        }
    }
    $genStr .= $str ? '<div class="form-group">' . $str . ' </div>' : '';
    if($field_dynamic && !$per_option){
        $genStr .= generateFieldDynamic($field_value, 0, $per_option, $field_dynamic, $menu_id, $menu, $fName, $menu_info, $default_value, '', '', $loop);
    }
    $genStr .= ' </div>';

    return $genStr;
}

function generateFieldDynamic($field_value, $is_test, $per_option, $field_dynamic, $menu_id, $menu, $fName, $menu_info, $default_value, $type_key = '', $count_key = '', $loop = NULL){
    $str = '';

    $field_dynamic = (Array)json_decode($field_dynamic);
    if(count($field_dynamic) > 0){
        $rowCount = 6;//floor(12/count($field_dynamic));
        $str .= '<div class="form-group row fieldDynamicArea" style="margin-bottom: 5px;">';
        foreach($field_dynamic as $k=>$v){
            $fn =
                $per_option ?
                    'data[' . $menu_id . ']' . $menu . '[' . $fName . ']' . ($type_key ? '[' . $type_key . ']' : '') .  '[' . $k . ']' :
                    'data[' . $menu_id . ']' . $menu . '[' . $fName . $k . ']';
            if($field_value->field_group || $field_value->is_multiple){
                $fn .= '[]';
            }
            $thisFn = $per_option ? $fName : $fName . $k;
            $menu_info_empty = count($menu_info) == 0;
            $default_value =
                $menu_info_empty ? '' :
                    (array_key_exists($thisFn, $menu_info) ? $menu_info->$thisFn : $default_value);
            if($field_value->field_group || $field_value->is_multiple){
                $dArray = $default_value ? json_decode($default_value) : array();
                $default_value = array_key_exists($loop, $dArray) ? $dArray[$loop] : '';
            }
            $input_field_value = $default_value;
            if($per_option && !$menu_info_empty){
                $input_field_value = is_array($default_value) ? (array_key_exists($k, $default_value) ? $default_value[$k] : '') : '';
            }
            if(is_array($v) || is_object($v)){
                reset($v);
                $first_key = key($v);
                $input_field_value = !$input_field_value ? $first_key : $input_field_value;
                $str .= '<div class="col-md-6">';
                foreach($v as $key=>$opt){
                    $fN = !$is_test ? $fn . '[' . $count_key . ']' : $fn;
                    $str .= '<input type="radio" name="' . $fN . '" value="' . $key . '" ' . ($input_field_value == $key ? 'checked' : '') . ($is_test ? ' disabled' : '') . '> ' . $opt . '&nbsp;';
                }
                $str .= '</div>';
            }
            else{
                $fn .= $per_option ? '[]' : '';
                $placeholder = ucwords(implode(" ", array_filter(explode("_", $k))));
                if($v == "checkbox"){
                    $str .=
                        '<div class="col-md-6">
                            <input type="checkbox" name="' . $fn . '" value="1" ' . ($input_field_value == 1 ? 'checked' : '') . ($is_test ? ' disabled' : '') . '>
                            ' . $placeholder . '
                        </div>';
                }
                else{
                    $str .=
                        '<div class="col-md-' . $rowCount . '">
                            <input type="' . $v . '" class="form-control input-sm" name="' . $fn . '" placeholder="' . $placeholder . '" value="' . $input_field_value . '"' . ($is_test ? ' disabled' : '') . '>
                         </div>';
                }
            }
        }
        $str .= '</div>';
    }

    return $str;
}

function hasMultiple($m = array(), $v, $menu_info_empty = '', $default_value = '', $menu_info = array(), $menu = '', $option = array(), $field_name = '',$room_id = 0,$_field = []){
    $loop = 1;
    if($v->field_dynamic){
        $fd = json_decode($v->field_dynamic);
        reset($fd);
        $first_key = key($fd);
        $dynamicFn = $v->field_name . $first_key;
        $default_value = @array_key_exists($dynamicFn, $menu_info) ? $menu_info->$dynamicFn : $default_value;
    }
    if($v->field_group || $v->is_multiple){
        $dvArray = json_decode($default_value);
        $mLoop = count($dvArray) - 1;
        $loop += $mLoop;
    }
    $loop = $loop < 1 ? 1 : $loop;
    for($i = 0; $i < $loop; $i ++){
        $str = '';
        $jsonValue = $default_value ? json_decode($default_value) : array();
        $inpt_default_value = $v->field_group || $v->is_multiple ?
            (array_key_exists($i, $jsonValue) ? $jsonValue[$i] : '') :
            $default_value;
        $field_name = $v->field_name . (!$v->field_dynamic && ($v->field_group || $v->is_multiple) ? '][' : '');
        $str .= "<div class='col-md-" . ( $menu && $v->is_resize ? 2 : ( $menu ? 3 : 3) ). "'>";
        $genStr = generateInputs($v, $v->per_option, $inpt_default_value, $menu_info, $menu, $m->id, $v->data_type_id, $v->option_id, $option, $field_name, ($i == 0 ? $v->field_label : ''), $v->field_dynamic, $v->label_header, $v->field_style, $i);
        $str .= $genStr;
        if($v->has_room_dropdown){
            $str .= "</div><div class='col-md-2'>" . ($i == 0 ? "<label class='control-label'>&nbsp;</label>" : '');
            $room = array('' => '-');
            $room += $option[2][2][1];

            $dp_field_name = $v->field_name . '_room_id';
            $dp_default_value =
                $menu_info_empty ? '' :
                    (array_key_exists($dp_field_name, $menu_info) ? $menu_info->$dp_field_name : '');
            $dp_jsonValue = $dp_default_value ? json_decode($dp_default_value) : array();
            $dp_default_value = $v->is_multiple ?
                (array_key_exists($i, $dp_jsonValue) ? $dp_jsonValue[$i] : '') :
                $dp_default_value;
            $str .= form_dropdown(
                'data[1][' . $dp_field_name . ']' . ($v->is_multiple ? '[]' : ''),
                $room, $dp_default_value,
                'class="form-control input-sm" title="Select Room"'
            );
        }
        if($v->has_defect_button){
            $_id = $v->id .'-' . $room_id;
            $_has_defect_noted = in_array($_id,$_field) ? '<span style="font-size: 10px;">[Y]</span>' : '';
            $str .= "</div><div class='col-md-1'><label class='control-label'>&nbsp;</label>";
            $str .= '<div class="form-group"><button type="button" class="btn btn-danger defect-btn is-hide" disabled id="'. $_id . '" data-value="' . $m->id . '--' . $room_id .'"><span class="button-text">D</span>' . $_has_defect_noted . '</button></div>';
        }
        if($v->is_multiple){
            $str .= "</div><div class='col-md-4'>" . ($i == 0 ? "<label class='control-label'>&nbsp;</label>" : "");
            if($i == 0){
                $str .= '<div class="form-group"><input type="button" class="btn btn-primary addAnotherGenerateInputs" data-group="' . $v->field_group . '" value="Add Another" /></div>';
            }
            else{
                $str .= '<div class="form-group"><input type="button" class="btn btn-danger removeAnotherGenerateInputs" value="Remove" data-toggle="modal" data-target="#removeField" aria-hidden="true"/></div>';
            }
        }

        global $field_group;
        if(($v->field_group || $v->is_multiple) && $i > 0){
            $field_group[$v->field_group][$i][] =
                str_replace("<label class='control-label'>Window Size: &nbsp;</label>", "", $str) . "</div>";
        }
        if($i == 0){
            echo $i == 0 ? '' : '</div><div class="row addAnotherGenerateRow" data-group="' . $v->field_group . '">';
            echo $str;
            echo "</div>";
        }
        if($v->has_defect_button){
            echo '<div class="defect-container" style="display: none;" id="defect-' . $v->id . '-' . $room_id . '">';
                echo '<div class="col-sm-4">';
                    echo '<div class="form-group">';
                        defectArea($m,array(),$room_id, array(), $v->id);
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
    }

    if($v->next_break && ($v->field_group || $v->is_multiple) && $field_group){
        if(array_key_exists($v->field_group, $field_group)){
            foreach ($field_group[$v->field_group] as $value) {
                echo '</div><div class="row addAnotherGenerateRow" data-group="' . $v->field_group . '"><div class="col-md-12"><hr /></div>';
                echo implode('', $value);
            }
        }
        $field_group = array();
    }
}

function defectArea($m, $defects, $room_id = 0, $dropdown = array(),$field_id = '',$show_form_input = true){
    //region Defects Area
    ?>
    <div class="<?php echo $show_form_input ? 'defect-panel' : 'defect-panel-list'?> panel panel-primary" id="<?php echo $m->id.'-'.$field_id . '-' . $room_id ?>">
        <div class="panel-heading form-inline">
            <span style="font-size: 13px">Defects <?php echo $show_form_input ? '' : ' List'?> </span>
        </div>
        <div class="panel-body">
            <?php
            if($show_form_input){
                //echo form_open_multipart('jobDefects','class="upload-form"');
                ?>
                <input type="hidden" name="menu_id" class="jobDefectsMenuId" value="<?php echo $m->id ?>" />
                <input type="hidden" name="room_id" class="jobDefectsRoomId" value="<?php echo $room_id ?>" />
                <input type="hidden" name="field_id" class="jobDefectsFieldId" value="<?php echo $field_id ?>" />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group file-input-content">
                            <input type="file" name="jobDefects[]" class="file jobDefects" id="job-defect-<?php echo $m->id . '-' . $field_id. '-' . $room_id ?>" multiple/>
                        </div>
                        <?php
                        if(count($dropdown) > 0){
                            echo '<div class="form-group">';
                            echo form_dropdown(
                                $dropdown['name'], $dropdown['value'], null,
                                'class="jobDefectDropdown form-control input-sm" id="' . $dropdown['name'] . '" title="'. $dropdown['title'] .'"'
                            );
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="title" class="jobDefectTitle form-control input-sm" placeholder="Defect Title" />
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea name="description" class="jobDefectDescription form-control input-sm" rows="8" style="resize: none;" placeholder="Defect Information"></textarea>
                        </div>
                    </div>
                </div><br/>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group text-right">
                            <div class="alert alert-danger hidden" role="alert">Failed to upload a file</div>
                            <input type="button" name="upload" class="btn btn-primary jobUploadBtn" value="Upload" disabled/>
                        </div>
                    </div>
                </div>
                <br />
            <?php
                //echo form_close();
            }
            if(count($defects) > 0){
                ?>
                <div class="row">
                    <?php
                    foreach($defects as $d){
                        echo form_open('jobDefectsUpdate/' . $d->id,'class="form-horizontal" id="form-'. $d->id . '"');
                        if($d->menu_id == $m->id && $d->room_id == $room_id){
                            ?>
                            <div class="col-md-6 defect-content" id="defect-data-<?php echo $d->id;?>" style="margin-bottom: 10px;">
                                <div class="panel panel-primary">
                                    <div class="panel-heading form-inline">
                                        <div class="row">
                                            <div class="col-sm-9" data-toggle="collapse" data-target="#defect_view_<?php echo $d->id ?>">
                                                <span class="text-view" style="font-size: 13px;">
                                                    <?php echo '<span class="title">' . $d->title .'</span>' ?>
                                                    <?php
                                                    if(count($dropdown) > 0){
                                                        echo '<em>(<span class="drop-down">' . $dropdown['value'][$d->$dropdown['name']] . '</span>)</em>';
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="input-view" style="display: none">
                                                <div class="<?php echo count($dropdown) > 0 ? 'col-sm-5' : 'col-sm-9'?>">
                                                    <input type="text" name="title" class="form-control input-sm title-input for-edit" value="<?php echo $d->title ?>">
                                                </div>
                                                <?php
                                                if(count($dropdown) > 0){
                                                    ?>
                                                    <div class="col-sm-4">
                                                        <?php echo form_dropdown(
                                                            $dropdown['name'], $dropdown['value'], $d->$dropdown['name'],
                                                            'class="jobDefectDropdown form-control input-sm dp-input for-edit" id="' . $dropdown['name'] . '" title="'. $dropdown['title'] .'"'
                                                        );?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="pull-right">
                                                    <span class="glyphicon glyphicon-pencil icon editDefectsBtn" style="font-size: 18px;" id="<?php echo $d->id ?>"></span>&nbsp;
                                                    <span class="glyphicon glyphicon-trash icon deleteModalBtn" style="font-size: 18px;" data-toggle="modal" data-target="#deleteDefect" id="<?php echo $d->id ?>" aria-hidden="true"></span>&nbsp;
                                                    <span class="glyphicon glyphicon-upload icon uploadModalBtn" style="font-size: 18px;<?php echo count($d->dir) > 0 ? 'display:none' : ''?>" data-toggle="modal" data-target="#uploadImage" id="<?php echo $d->id ?>" aria-hidden="true"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="defect_view_<?php echo $d->id ?>" class="panel-body panel-collapse collapse in">
                                        <div class="row">
                                            <?php
                                            if(count($d->dir) > 0){
                                                echo '<div class="col-md-5">';
                                                foreach ($d->dir as $key=>$files) {
                                                    echo '<div class="thumbnail">';
                                                    $path = realpath(APPPATH.'../');
                                                    $size = @file_exists($path .'/' . $files);
                                                    if($size){
                                                        echo '<img src="' . base_url($files) . '" />';
                                                    }
                                                    else{
                                                        echo '<div class="thumbnailNonImage" >' . strtoupper(substr(strrchr($files, '.'), 1)) . '</div>';
                                                    }
                                                    echo '<div class="panel-footer" style="text-align: center;padding: 5px!important;">';
                                                    echo $size ? '<span class="glyphicon glyphicon-eye-open icon showBtn" data-toggle="modal" data-target="#showDefect" style="font-size: 23px;margin-right: 5px;"></span>' : '';
                                                    echo '<a class="downloadLink icon for-edit" href="' . base_url($files) . '" excel_reader="' . basename($files) . '">
                                                                <span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true" style="font-size: 23px;"></span>
                                                            </a>';
                                                    echo '<a class="uploadImageBtn icon for-edit" style="display:none;" href="#" id="' . $d->id . '" data-toggle="modal" data-target="#changePhoto" aria-hidden="true">
                                                                <span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true" style="font-size: 23px;"></span>
                                                            </a>';
                                                    echo '<a class="deleteImage icon pull-right" href="#" id="' . $d->id . '" data-toggle="modal" data-target="#deletePhoto" aria-hidden="true">
                                                                <span class="glyphicon glyphicon-trash" aria-hidden="true" style="font-size: 20px;"></span>
                                                            </a>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                            }
                                            else{
                                                echo '<div class="col-md-5">';
                                                echo '<div class="thumbnail">';
                                                echo '<div class="thumbnailNonImage">No image</div>';
                                                echo '</div>';
                                                echo '</div>';
                                            }
                                            echo '<div class="col-md-7">';
                                            /*$len = strlen($d->description);
                                            $max = 220;
                                            echo substr($d->description, 0, $max);
                                            if($len > $max){
                                                echo '<span id="descriptionReadMore" class="collapse">';
                                                echo substr($d->description, $max, $len);
                                                echo '</span>';
                                                echo ' <a class="descriptionReadMoreBtn">[Read More]</a>';
                                            }*/
                                            echo '<div class="text-view">';
                                            echo '<div style="border: 1px solid #d2d2d2;border-radius: 4px;padding: 10px;height: 130px;">';
                                            echo '<span class="description">' . $d->description .'</span>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '<div class="input-view" style="display: none;">';
                                            echo form_textarea(['name'=>'description','value'=>$d->description,'rows'=>7,'class'=>'form-control input-sm desc-input for-edit']);
                                            echo '</div>';
                                            echo '</div>';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="input-view" style="display: none">
                                        <div class="panel-footer">
                                            <div class="text-right">
                                                <button type="button" class="btn btn-sm btn-success for-edit">Update</button>
                                                <button type="button" class="btn btn-sm btn-danger for-edit">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        echo form_close();
                    }
                    ?>
                </div>
                <?php
            }
            else{
                echo $show_form_input ? ''  : 'No data was found.';
            }
            ?>
        </div>
    </div>
    <?php
    //endregion
}
?>

<div class="modal fade" id="showDefect">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Image</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <a class="downloadLinkModal" href="#" download="">
                    <button type="button" class="btn btn-primary">
                        <span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true"></span> Download
                    </button>
                </a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteDefect">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Defect</h4>
            </div>
            <div class="modal-body">Are you sure you want to delete this defect?</div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-danger yesDeleteBtn" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="uploadImage">
    <div class="modal-dialog modal-df">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Photo</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input type="file" name="dir[]" class="file defectPhoto" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="upload-photo btn btn-primary" disabled>
                    <span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span> Upload
                </button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deletePhoto">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Photo</h4>
            </div>
            <div class="modal-body">Are you sure you want to delete this photo?</div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-danger yesDeletePhotoBtn" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="removeField">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Remove Field</h4>
            </div>
            <div class="modal-body">Are you sure you want to remove this field?</div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-danger yesRemoveFieldBtn" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changePhoto">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change Photo</h4>
            </div>
            <div class="modal-body">Do you need to change the photo for this defect?</div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-danger yesBtn" data-dismiss="modal">Yes</button>
                <button type="button" class="btn btn-primary noBtn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteTab">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Remove Tab</h4>
            </div>
            <div class="modal-body">The <strong class="tab-name"></strong> tab cannot be removed until all its data has been cleared.</div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
(function (e){
    //region Declare variable
    var body = $('body');
    var date = body.find('.date');
    var job_name = body.find('.job_name');
    var id = job_name.val();
    var defect_list = $('.defect-panel-list');
    var _thisid = '<?php echo $this->uri->segment(2);?>';
    date.datetimepicker({
        format: 'DD/MM/YYYY H:m'
    });
    defect_list.on('mouseover','img',function(){
        $(this).elevateZoom({
            zoomWindowWidth: 400,
            zoomWindowHeight: 200
        });
    });
    var property_status = $('.property_status');
    var property_status_other = $('.property_status_other');
    property_status.change(function(e){
        if($(this).val() == "other"){
            property_status_other
                .addClass('required')
                .removeAttr('disabled');
        }
        else{
            property_status_other
                .removeClass('required')
                .val('')
                .attr('disabled', 'disabled');
        }
    });

    var saveBtn = body.find('.saveBtn');
    saveBtn.click(function(e){
        var hasEmpty = false;

        $('.required').each(function(e){
            $(this).removeClass('error');
            if($(this).val() == ""){
                hasEmpty = true;
                $(this).addClass('error');
                console.log($(this).attr('name'));
            }
        });

        if(hasEmpty){
            console.log('has error');
            e.preventDefault();
        }
    });

    var room_name = body.find('.room_name');
    var room_tab = body.find('.room_tab');
    var room_pane = body.find('.tab-pane');
    var tab_content = body.find('.tab-content');
    var roomsSelected = '<?php echo count(json_decode($interior_selected)) > 0 ? $interior_selected : (count($session_rooms) > 0 ? json_encode($session_rooms) : '[]'); ?>';
    var _tab = $('#deleteTab');
    room_name
        .selectpicker({
            width: '100%',
            style: 'btn-info'
        })
        .on('change', function(e){
            var thisVal = room_name.val();
            thisVal = thisVal != null ? thisVal : [];
            room_tab.each(function(e){
                var _room = tab_content.find('#room_' + this.id);
                var _tab_name = $('.nav-tabs').find('.room_tab#' + this.id);
                if($.inArray(this.id, thisVal) != -1){
                    $(this).removeClass('hidden');
                }
                else{
                    if(_room.find('.defect-content').length){
                        thisVal.push(this.id);
                        room_name.selectpicker('val', thisVal);
                        _tab.find('.tab-name').html(_tab_name.find('a').html());
                        _tab.modal('show');
                    }
                    else{
                        tab_content.find('#room_' + this.id).removeClass('active');
                        $(this).addClass('hidden');
                    }
                }
            });
            $.post(bu + 'selectedRooms/' + _thisid,{rooms: thisVal},function(res){});
            room_pane.each(function(e){
                $(this).tab('show');
            });
        });
    var _has_defect_list = function(){
        var _this_val = [];
        var _id = '';
        room_tab.each(function(e){
            var _room = tab_content.find('#room_' + this.id);
            var _tab_name = $('.nav-tabs').find('.room_tab#' + this.id);
            if(_room.find('.defect-content').length){
                _this_val.push(this.id);
                $(this).removeClass('hidden');
                _id = this.id;
            }
            else{
                tab_content.find('#room_' + this.id).removeClass('active');
                $(this).addClass('hidden');
            }
        });
        if(_id){
            $('.room_tab#' + _id + ' a').tab('show');
        }

        room_name.selectpicker('val', _this_val);
    };
    room_name.selectpicker('val', jQuery.parseJSON(roomsSelected));
    _has_defect_list();

    var checkBoxOption = $('.checkBoxOption');
    var howMany = $('.howMany');
    checkBoxOption.click(function(e){
        var thisEle = $(this).parent().next('.textOption');
        if($(this).is(':checked')){
            thisEle
                .removeAttr('disabled')
                .removeClass('hidden');
        }
        else{
            thisEle
                .attr('disabled', 'disabled')
                .addClass('hidden');
        }
    });
    howMany
        .stop()
        .on('propertychange keyup input paste', function(e){
            e.stopPropagation();
            var thisEle = $(this).parent().next('.textOption');
            var howMany =  parseInt($(this).parent().find('.howMany').val());
            var fieldDynamicArea = thisEle.find('.fieldDynamicArea');

            thisEle.parent().find('.fieldDynamicAreaExtra').remove();
            if(howMany > 0){
                var afterEle = '';
                for(var i = 0;i < howMany;i ++){
                    var n = fieldDynamicArea.find('input[type="radio"]').attr('name');
                    fieldDynamicArea.find('input[type="radio"]').attr('name', n + '[' + i + ']');
                    afterEle += '<div class="form-inline fieldDynamicAreaExtra" style="margin-bottom: 5px;">' + fieldDynamicArea.html() + '</div>';
                    fieldDynamicArea.find('input[type="radio"]').attr('name', n);
                }
                if(afterEle){
                    thisEle.after(afterEle);
                    thisEle.parent().find('.fieldDynamicAreaExtra').find('input').removeAttr('disabled');
                }
            }
        });

    var addAnotherGenerateInputs = $('.addAnotherGenerateInputs');
    addBorderBottom();
    addAnotherGenerateInputs.click(function(e){
        var thisEle = $(this).parent().parent().parent();
        var thisGroup = $(this).data('group');
        if($(this).closest('.row').nextAll('.addAnotherGenerateRow[data-group="' + thisGroup + '"]').length == 0){
            thisEle.after('<div class="row addAnotherGenerateRow" data-group="' + thisGroup + '"><div class="col-md-12"><hr /></div>' + thisEle.html() + '</div>');
        }
        else{
            $(this).closest('.row').nextAll('.addAnotherGenerateRow[data-group="' + thisGroup + '"]')
                .last()
                .after('<div class="row addAnotherGenerateRow" data-group="' + thisGroup + '"><div class="col-md-12"><hr /></div>' + thisEle.html() + '</div>')
        }

        var addAnotherGenerateRow = $(this).closest('.row').nextAll('.addAnotherGenerateRow[data-group="' + thisGroup + '"]').last();
        addAnotherGenerateRow
            .find('label')
            .remove();
        addAnotherGenerateRow
            .find('.addAnotherGenerateInputs')
            .removeClass('btn-primary addAnotherGenerateInputs')
            .addClass('btn-danger removeAnotherGenerateInputs')
            .attr({'data-toggle':'modal','data-target':'#removeField','aria-hidden':'true'})
            .val('Remove');
        addAnotherGenerateRow
            .find('.form-control input-sm')
            .val('');
        addAnotherGenerateRow
            .find('.removeAnotherGenerateInputs')
            .on('click', function(e){
                var _remove_this = $(this).parent().parent().parent();
                $('.yesRemoveFieldBtn').on('click',function(e) {
                    _remove_this.remove();
                });
            });
        addBorderBottom();
        var _defect_btn = thisEle.siblings('.addAnotherGenerateRow').find('.defect-btn');
        var _defect_container = thisEle.siblings('.addAnotherGenerateRow').find('.defect-container');
        var _job_defect = thisEle.siblings('.addAnotherGenerateRow').find('.jobDefects');
        var _defect_panel = thisEle.siblings('.addAnotherGenerateRow').find('.defect-panel');
        _defect_btn.find('span:nth-child(2)').remove();
        if(_defect_btn.length > 0){
            var job_defect_id = _job_defect.attr('id');
            _defect_panel.find('.file-input.file-input-new').remove();
            _defect_panel.find('.file-input-content').html('<input type="file" name="jobDefects[]" class="file jobDefects" id="'+ job_defect_id +'">');
            _defect_btn.each(function(e){
                var _id = this.id + '-' + (e + 1);
                $(this).attr('id',_id);
            });
            _defect_container.each(function(e){
                var _id = this.id + '-' + (e + 1);
                $(this).attr('id',_id);
            });
            _job_defect.each(function(e){
                var _id = this.id + '-' + (e + 1);
                $(this).attr('id',_id);
            });
            _defect_panel.each(function(e){
                var _id = this.id + '-' + (e + 1);
                $(this).attr('id',_id);
            });
        }
    });

    function addBorderBottom(){
        var addAnotherGenerateRowGroup = [];
        $('.addAnotherGenerateRow').each(function(e){
            if($.inArray($(this).data('group'), addAnotherGenerateRowGroup) == -1){
                addAnotherGenerateRowGroup.push($(this).data('group'));
            }
        });
        $.each(addAnotherGenerateRowGroup, function(k, v){
            var addAnotherRow = $('.addAnotherGenerateRow[data-group="' + v + '"]');
            addAnotherRow.removeClass('hasBottomBorder');
            addAnotherRow.last().addClass('hasBottomBorder');
        });
    }

    $('.removeAnotherGenerateInputs')
        .on('click', function(e){
            var _remove_this = $(this).parent().parent().parent();
            $('.yesRemoveFieldBtn').on('click',function(e){
                _remove_this.remove();
                addBorderBottom();
            });
        });
    //endregion

    var jobDefects = body.find('.jobDefects');
    var jobDefectTitle, jobDefectDescription, jobDefectsMenuId, jobDefectsRoomId, jobDefectsFieldId, jobUploadBtn;
    var jobDefectDropdown;
    var hasUploadFile = 0;

    $('.menu-panel').on('shown.bs.collapse', function () {
        jobDefectTitle = $(this).find('.jobDefectTitle');
        jobDefectDescription = $(this).find('.jobDefectDescription');
        jobDefectsMenuId = $(this).find('.jobDefectsMenuId');
        jobDefectsFieldId = $(this).find('.jobDefectsFieldId');
        jobDefectsRoomId = $(this).find('.jobDefectsRoomId');
        jobDefectDropdown = $(this).find('.jobDefectDropdown');
        jobUploadBtn = $(this).find('.jobUploadBtn');
        setTabIndex();
        addEventAgain();
    });
    room_tab.on('shown.bs.tab', function () {
        var tab_panel_active = $('.tab-pane.active');
        jobDefectTitle = tab_panel_active.find('.jobDefectTitle');
        jobDefectDescription = tab_panel_active.find('.jobDefectDescription');
        jobDefectsMenuId = tab_panel_active.find('.jobDefectsMenuId');
        jobDefectsFieldId = tab_panel_active.find('.jobDefectsFieldId');
        jobDefectsRoomId = tab_panel_active.find('.jobDefectsRoomId');
        jobDefectDropdown = tab_panel_active.find('.jobDefectDropdown');
        jobUploadBtn = tab_panel_active.find('.jobUploadBtn');
        addEventAgain();
    });

    var defect_btn = $('.panel-group').find('.defect-btn');
    function setTabIndex(edit,_class){
        if(edit){
            _class.each(function(e){
                $(this).attr('tabindex',(e + 1));
            });
        }
        else{
            $('.icon').each(function(e){
                $(this).attr('tabindex',(e + 1));
            });
        }

    }

    body.on('click','.defect-btn',function(){
        var defect_ = $('#defect-' + this.id);
        var _this = $(this);
        var _defect_list_id = $(this).data('value');
        var _has_file_input = defect_.find('.file-input.file-input-new').length;
        if(_this.hasClass('is-hide')){
            _this
                .addClass('is-open')
                .removeClass('is-hide');
            _this.find('.button-text').html('Hide');
            defect_.css({display:'inline'});
        }
        else{
            _this
                .addClass('is-hide')
                .removeClass('is-open');
            _this.find('.button-text').html('D');
            defect_.css({display:'none'});
        }

        var _jobDefects = defect_.find('.jobDefects');
        var jobDefectsMenuId = defect_.find('.jobDefectsMenuId'),
            jobDefectTitle = defect_.find('.jobDefectTitle'),
            jobDefectDescription = defect_.find('.jobDefectDescription'),
            jobDefectsRoomId = defect_.find('.jobDefectsRoomId'),
            jobDefectsFieldId = defect_.find('.jobDefectsFieldId'),
            jobDefectDropdown = defect_.find('.jobDefectDropdown'),
            _jobUploadBtn = defect_.find('.jobUploadBtn'),
            jobDefectForm = defect_.find('.upload-form'),
            jobUploadBtn = defect_.find('.jobUploadBtn');
        form_url(jobDefectForm,job_name.val());

        jobDefectDescription
            .add(jobDefectTitle)
            .on('propertychange keyup input paste', function(e) {
                _jobUploadBtn.hasClass('');
                if(jobDefectTitle.val() != "" && jobDefectDescription.val() != ""){
                    _jobUploadBtn.removeAttr('disabled');
                }
                else{
                    _jobUploadBtn.attr('disabled','disabled');
                }
            });
            _jobDefects
                .fileinput({
                    uploadAsync: false,
                    uploadUrl: bu + "jobDefects",
                    allowedFileExtensions: ['jpg', 'png', 'gif'],
                    showRemove: false,
                    showUpload: true,
                    autoReplace: true,
                    showPreview: false,
                    uploadClass: "btn btn-info hide-btn",
                    maxFileCount: 1,
                    maxFileSize: 10000,
                    uploadExtraData: function(e){
                        var data = {
                            menu_id: jobDefectsMenuId.val(),
                            title: jobDefectTitle.val(),
                            description: jobDefectDescription.val(),
                            field_id: jobDefectsFieldId.val(),
                            job_id: job_name.val()
                        };
                        if(jobDefectsRoomId.val()){
                            data['room_id'] = jobDefectsRoomId.val();
                        }
                        if(jobDefectDropdown.length != 0){
                            data[jobDefectDropdown.attr('id')] = jobDefectDropdown.val();
                        }

                        return data;
                    }
                })
                .on('filebatchuploadcomplete', function(event, files, extra) {
                })
                .on('fileuploaderror', function(event, data, previewId, index) {
                    var _this = this;
                    var size = 0;
                    var alert_warning = $('.alert-danger');
                    var msg = '';
                    if(this.files.length > 1){
                        msg = '<strong>Error!</strong> Please select only one image.'
                    }
                    else{
                        $.each(this.files,function(k,v){
                            size += _this.files[k].size;
                        });
                        if(size > 2000){
                            msg = '<strong>Error!</strong> Please enter a file with a valid file size no larger than 10Mb.'
                        }
                        else{
                            msg = '<strong>Error!</strong> Uploading file to server.'
                        }
                    }

                    alert_warning.html(msg);
                    alert_warning.css({'text-align':'left'});
                    alert_warning.removeClass('hidden');
                    jobDefects.fileinput('clear');
                    hasUploadFile = 0;
                })
                .on('fileloaded', function(event, file, previewId, index, reader) {
                    hasUploadFile = 1;
                    _jobUploadBtn.attr('disabled','disabled');
                    if(jobDefectTitle.val() && jobDefectDescription.val()){
                        _jobUploadBtn.removeAttr('disabled');
                    }

                    jobDefectDescription
                        .add(jobDefectTitle)
                        .on('propertychange keyup input paste', function(e) {
                            if(hasUploadFile && jobDefectTitle.val() != "" && jobDefectDescription.val() != ""){
                                _jobUploadBtn.removeAttr('disabled');
                            }
                            else{
                                _jobUploadBtn.attr('disabled','disabled');
                            }
                        });
                })
                .on('filebatchpreupload',function(event, data, previewId, index, jqXHR){
                })
                .on('fileuploaded', function(event, data, previewId, index) {
                    var job_id = data.response.job_id;
                    var room_id = data.response.room_id;
                    var menu_id = data.response.menu_id;
                    var url = '?job_id=' + job_id + '&menu_id=' + menu_id;
                    var _defect_panel_list = $('.defect-panel-list#' + _defect_list_id + ' .panel-body');

                    url += room_id ? '&room_id=' + room_id : '';
                    _jobUploadBtn.attr('disabled', 'disabled');
                    jobDefectTitle.val('');
                    jobDefectDescription.val('');
                    _this
                        .addClass('is-hide')
                        .val('D')
                        .removeClass('is-open');
                    defect_.css({display:'none'});

                    _defect_panel_list.load(bu + 'jobDefectsLoad' + url);
                })
                .on('filecleared', function(event) {
                    hasUploadFile = 0;
                    _jobUploadBtn.attr('disabled', 'disabled');
                })
                .on('filebatchuploadsuccess', function(event, data) {
                    var job_id = data.response.job_id;
                    var room_id = data.response.room_id;
                    var menu_id = data.response.menu_id;
                    var url = '?job_id=' + job_id + '&menu_id=' + menu_id;
                    var _defect_panel_list = $('.defect-panel-list#' + _defect_list_id + ' .panel-body');

                    url += room_id ? '&room_id=' + room_id : '';
                    _jobUploadBtn.attr('disabled', 'disabled');
                    jobDefectTitle.val('');
                    jobDefectDescription.val('');
                    _this
                        .addClass('is-hide')
                        .removeClass('is-open');
                    _this.html('<span class="button-text">D</span><span style="font-size: 10px">[Y]</span>');
                    defect_.css({display:'none'});

                    _defect_panel_list.load(bu + 'jobDefectsLoad' + url);

                    $('img').elevateZoom({
                        zoomWindowWidth: 400,
                        zoomWindowHeight: 200
                    });
                });
        _jobUploadBtn.click(function(e){
            defect_.find('.fileinput-upload.fileinput-upload-button').trigger('click');
        });
    });
    body.on('click','.editDefectsBtn',function(){
        var _defect_panel = $('#defect-data-' + this.id);
        var _input_view = _defect_panel.find('.input-view');
        var _text_view = _defect_panel.find('.text-view');
        var _btn_submit = _defect_panel.find('.btn-success');
        var _btn_cancel = _defect_panel.find('.btn-danger');
        var _form = _defect_panel.parents('#form-' + this.id);
        var _title_df = _defect_panel.find('.title');
        var _drop_down_df = _defect_panel.find('.drop-down');
        var _description_df = _defect_panel.find('.description');
        var _title = _defect_panel.find('.title-input');
        var _drop_down = _defect_panel.find('.dp-input');
        var _description = _defect_panel.find('.desc-input');
        var _dp_option = _defect_panel.find('.dp-input option:selected');
        var _upload_btn = _defect_panel.find('.uploadImageBtn');
        var _download_link = _defect_panel.find('.downloadLink');

        var _this = $(this);
        _text_view.css({'display':'none'});
        _input_view.css({'display':'inline'});
        _this.css({'display':'none'});
        _upload_btn.css({'display':'inline'});
        setTabIndex(true,_defect_panel.find('.for-edit'));
        _title.focus();
        var _has_dp = _drop_down.length ? _drop_down_df.html() != _dp_option.html() : false;
        _btn_cancel.on('click',function(){
            if(_title_df.html() != _title.val() ||
                _has_dp ||
                _description_df.html() != _description.val()){
                var ele =
                    '<div class="modal-body">' +
                        '<div class="row">' +
                            '<div class="col-sm-12">' +
                            'Would you like to save your changes?' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="modal-footer">' +
                        '<button type="button" class="btn btn-success btn-sm yes-btn" data-dismiss="modal">Yes</button>' +
                        '<button type="button" class="btn btn-default btn-sm no-btn" data-dismiss="modal">No</button>' +
                    '</div>';
                $(this).modifiedModal({
                    html: ele,
                    type: 'small',
                    title: 'Cancel Edit'
                });
                $('.yes-btn').on('click',function(e){
                    e.preventDefault();
                    var data = _form.serializeArray();
                    var url = _form.attr('action');
                    data.push({name:'submit',value:'1'});
                    $.post(url,data,function(res){
                        _title_df.html(_title.val());
                        _drop_down_df.html(_dp_option.html());
                        _description_df.html(_description.val());
                        _text_view.css({'display':'inline'});
                        _input_view.css({'display':'none'});
                        _this.css({'display':'inline'});
                        _upload_btn
                            .css({'display':'none'});
                        _defect_panel.find('.for-edit').removeAttr('tabindex');
                        setTabIndex();
                    });
                });
                $('.no-btn').on('click',function(e){
                    e.preventDefault();
                    _text_view.css({'display':'inline'});
                    _input_view.css({'display':'none'});
                    _this.css({'display':'inline'});
                    _upload_btn
                        .css({'display':'none'});
                    _defect_panel.find('.for-edit').removeAttr('tabindex');
                    setTabIndex();
                });
            }
            else{
                _text_view.css({'display':'inline'});
                _input_view.css({'display':'none'});
                _this.css({'display':'inline'});
                _upload_btn
                    .css({'display':'none'});
                _defect_panel.find('.for-edit').removeAttr('tabindex');
                setTabIndex();
            }
        });
        _btn_submit.on('click',function(){
            var data = _form.serializeArray();
            var url = _form.attr('action');
            data.push({name:'submit',value:'1'});
            $.post(url,data,function(res){
                _title_df.html(_title.val());
                _drop_down_df.html($('.dp-input option:selected').html());
                _description_df.html(_description.val());
                _text_view.css({'display':'inline'});
                _input_view.css({'display':'none'});
                _this.css({'display':'inline'});
                _upload_btn
                    .css({'display':'none'});
                _defect_panel.find('.for-edit').removeAttr('tabindex');
                setTabIndex();
            });
        });
    });
    body.on('click','.uploadImageBtn',function(){
        var _id = this.id;

        $('.yesBtn').on('click',function(e){
            e.preventDefault();
            $('#defect-data-' + _id).find('.uploadModalBtn').trigger('click');
        });
    });
    <?php
    $room_id = isset($_GET['room_id']) ? $_GET['room_id'] : '';
    echo $menu_id != '' ? "$('.menu-panel[data-menu-id=\"" . $menu_id . "\"]').collapse('show');\n" : "";
    echo $room_id ? "$('.room_tab#" . $room_id . " a').tab('show');$('.room_tab#" . $room_id . "').removeClass('hidden');" : "";
    ?>

    function selectedRoom(data){
        $.each(jQuery.parseJSON(data),function(index,val){
            $('.room_tab#' + val + ' a').tab('show');
            $('.room_tab#' + val).removeClass('hidden');
        });
    }

    selectedRoom(roomsSelected);

    function addEventAgain(){
        jobDefectDescription
            .add(jobDefectTitle)
            .on('propertychange keyup input paste', function(e) {
                if(hasUploadFile && jobDefectTitle.val() != "" && jobDefectDescription.val() != ""){
                    jobUploadBtn.removeAttr('disabled');
                }
                else{
                    jobUploadBtn.attr('disabled','disabled');
                }
            });
        jobUploadBtn.click(function(e){
            $('.kv-fileinput-upload').trigger('click');
        });
    }

    var deleteModalBtn = $('.deleteModalBtn');
    var yesDeleteBtn = $('.yesDeleteBtn');
    var yesDeletePhotoBtn = $('.yesDeletePhotoBtn');
    var deleteDefectId = '';
    defect_list.on('click','.deleteModalBtn',function(e){
        deleteDefectId = this.id;
    });
    yesDeleteBtn.on('click',function(e){
        waitingDialog.show('Please wait...');
        $.ajax({
            url: '<?php echo base_url("jobDefectsDelete") ?>',
            method: "POST",
            data: {
                id: deleteDefectId
            },
            success: function(e) {
                $('#defect-data-' + deleteDefectId).remove();
                waitingDialog.hide();
            }
        });
    });
    var _id = '';
    var _this = '';
    var _upload_photo = '';
    defect_list.on('click','.deleteImage',function(e){
        e.preventDefault();
        _id = this.id;
        _this = $(this);
        _upload_photo = $(this).parent().parent().parent().parent().parent().parent().find('.uploadModalBtn');
    });
    yesDeletePhotoBtn.on('click',function(){
        waitingDialog.show('Please wait...');
        $.ajax({
            url: bu + 'jobDefectsDeleteImage/' + _id,
            method: "POST",
            data: {
                id: _id
            },
            success: function(e) {
                waitingDialog.hide();
                _this.css({'display':'none'});
                _this.siblings('a,.glyphicon').css({'display':'none'});
                _this.parents('.thumbnail').html('<div class="thumbnailNonImage">JPG</div>');
                _upload_photo.css({'display':'inline'});
            }
        });
    });
    defect_list.on('click','.uploadModalBtn',function(e){
        var _id = this.id;
        var _this = $(this);
        var upload_btn = $('.upload-photo');
        var defectPhoto = $('.defectPhoto');
        var _panel = $('#defect_view_' + _id);
        var thumbnail = _panel.find('.thumbnail');
        var img = $('img');
        $('#uploadImage').find('.modal-title').html('Upload Image');
        defectPhoto
            .fileinput({
                uploadAsync: false,
                uploadUrl: bu + "jobDefectsUploadImage/" + _id,
                allowedFileExtensions: ['jpg', 'png', 'gif'],
                showRemove: false,
                showUpload: true,
                showPreview: false,
                overwriteInitial: true,
                uploadClass: "btn btn-info hide-btn",
                maxFileCount: 1
            })
            .on('filebatchuploadcomplete', function(event, files, extra) {
            })
            .on('fileuploaderror', function(event, data, previewId, index) {
                $('.alert-danger').removeClass('hidden');
                defectPhoto.fileinput('clear');
                hasUploadFile = 0;
            })
            .on('fileloaded', function(event, file, previewId, index, reader) {
                hasUploadFile = 1;
                upload_btn.removeAttr('disabled');
            })
            .on('filebatchpreupload', function(event, data, id, index){
            })
            .on('filecleared', function(event) {
                hasUploadFile = 0;
                upload_btn.attr('disabled', 'disabled');
            })
            .on('filebatchuploadsuccess', function(event, data) {
                var _json = jQuery.parseJSON(data.response.dir);
                var d = new Date();
                var link = bu + 'defects/' + data.response.id + '/' + _json[0] + '?' + d.getTime();
                var ele = '<img src="' + link + '">';
                ele += '<div class="panel-footer" style="text-align: center;padding: 5px!important;">';
                ele += '<span class="glyphicon glyphicon-eye-open showBtn" data-toggle="modal" data-target="#showDefect" style="font-size: 20px;margin-right: 5px;"></span>';
                ele += '<a class="downloadLink" href="' + link + '" excel_reader="footer_logo_lbp.gif">';
                ele += '<span class="glyphicon glyphicon-circle-arrow-down" aria-hidden="true" style="font-size: 20px;"></span>';
                ele += '</a>';
                ele += '<a class="deleteImage" href="#" id="' + data.response.id + '" data-toggle="modal" data-target="#deletePhoto" aria-hidden="true">';
                ele += '<span class="glyphicon glyphicon-trash" aria-hidden="true" style="font-size: 18px;"></span>';
                ele += '</a>';
                ele += '<a class="uploadImageBtn" href="#" id="' + data.response.id + '" tabindex="5" style="display: inline;">';
                ele += '<span class="glyphicon glyphicon-circle-arrow-up" aria-hidden="true" style="font-size: 18px;"></span>';
                ele += '</a>';
                ele += '</div>';
                thumbnail.html('');
                thumbnail.html(ele);
                img.elevateZoom({
                    zoomWindowWidth: 400,
                    zoomWindowHeight: 200
                });
                $('.modal').modal('hide');
                _this.css({'display':'none'});
                $('.defectPhoto').fileinput('clear');
            });
        upload_btn.click(function(e){
            $('#uploadImage .fileinput-upload.fileinput-upload-button').trigger('click');
        });
    });
    $('#uploadImage.modal').on('hide.bs.modal', function (e) {
        // do something...
        $('.defectPhoto').fileinput('clear');
    });

    var s = $('.showBtn');
    defect_list.on('click','.showBtn',function (e) {
        var info = $(this).parent('').parent('').find('img');
        var imgSrc = info.attr('src');
        var imgDownload = $(this).next('.downloadLink');
        var downloadLinkModal = $('.downloadLinkModal');
        var sa = $('#showDefect');
        var mBody = sa.find('.modal-body');
        mBody.html('<img src="' + imgSrc + '" data-zoom-image="' + imgSrc + '" width="100%" />');
        downloadLinkModal.attr('href', imgDownload.attr('href'));
        downloadLinkModal.attr('excel_reader', imgDownload.attr('excel_reader'));
        mBody
            .find('img')
            .elevateZoom({
                zoomType: "lens",
                borderSize: 1,
                lensSize: 300
            });
    });
    defect_list.on('click','.descriptionReadMoreBtn',function(){
        var $this = $(this);
        $this.parent().find('#descriptionReadMore').collapse('toggle');
        $this.toggleClass('descriptionReadMoreBtn');
        if($this.hasClass('descriptionReadMoreBtn')){
            $this.text('[Read More]');
        }
        else {
            $this.text('[Read Less]');
        }
    });

    var propertyImage = $('.propertyImage');
    propertyImage
        .fileinput({
            uploadAsync: true,
            uploadUrl: bu + "jobReportOrientation/" + id,
            removeClass: "btn btn-danger",
            uploadClass: "btn btn-info",
            showPreview: false,
            showRemove: false,
            maxFileCount: 1,
            allowedFileTypes: ['image']
        });
    propertyImage
        .stop()
        .on('filebatchuploadcomplete', function(event, files, extra) {

        })
        .on('fileuploaderror', function(event, data, previewId, index) {
            propertyImage.fileinput('clear');
        })
        .on('fileloaded', function(event, file, previewId, index, reader) {
            hasUploadFile = 1;
        })
        .on('fileuploaded', function(event, data, previewId, index) {
            if(data.response.success){
                location.reload();
            }
        })
        .on('filecleared', function(event) {
            hasUploadFile = 0;
        })
        .on('filebatchuploadsuccess', function(event, data, previewId, index) {
            if(data.response.success){
                location.reload();
            }
        });

    job_name.change(function(e){
        var btn_defect = $('.defect-btn');
        btn_defect.attr('disabled','disabled');
        form_url('',$(this).val());
        getJobName($(this).val());
    });

    var getJobName = function(id){
        $.post(bu + 'onSiteVisit?has_id=1&job_id=' + id ,{id:id},function(data){
            getInfo(data);
        });
    };
    <?php
    if($this->uri->segment(2) && count(@$job_detail) == 0){
    ?>
        job_name.val(<?php echo $this->uri->segment(2);?>);
        getJobName('<?php echo $this->uri->segment(2);?>');
    <?php
    }
    if(isset($_GET['view'])){
    ?>
        $('#inspection').prepend('<div class="alert alert-info" role="alert"><strong>For viewing purpose only!</strong></div>');
        $('input[type=submit],input[type=button]:not(.unlock-btn)').attr('disabled','disabled');
    <?php
    }else{
    ?>
    var disabledDefectBtn = function(){
        defect_btn.attr('disabled','disabled');
        if(job_name.val()){
            defect_btn.removeAttr('disabled');
        }
    };
    disabledDefectBtn();
    <?php
    }
    ?>

    var form_url = function(selector,job_id,menu_id,room_id,field_id){
        if(!selector && job_id){
            $('.upload-form').attr('action', bu + 'jobDefects/' + job_id );
        }
        else if(selector && job_id){
            selector.attr('action', bu + 'jobDefects/' + job_id);
        }
    };
    var getInfo = function(data){
        data = jQuery.parseJSON(data);
        $('.job-details').each(function(e){
            var _val = data[$(this).data('type')];
            if($(this).attr('data-type')){
                if(!isNaN(Date.parse(_val))){
                    //_val = $.format.date(_val,'dd-MM-yyyy hh:mm a');
                }
                $(this).val(_val);
            }
        });
    };
})($);
</script>