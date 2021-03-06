<?php

include('merit.php');

class Job_Controller extends Merit{

    function __construct(){
        parent::__construct();
        if($this->session->userdata('isLogged') == false){
            redirect('login');
        }
    }

    function jobRegistration(){
        $this->load->helper('file');
        $link = $this->uri->segment(2);
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $history_id = isset($_GET['h_id']) ? $_GET['h_id'] : '';
        $job_data = array();

        $site = $this->db->site;
        $this->merit_model->setSelectFields(array('id', 'instruction_received'));
        $this->merit_model->setNormalized('instruction_received','id');
        $instruction_received = $this->merit_model->getInfo($site . '.tbl_instruction_received');
        $this->data['instruction_received'] = $instruction_received;

        $this->merit_model->setSelectFields(array('id', 'property_status'));
        $property_status = $this->merit_model->getInfo($site . '.tbl_property_status');
        $this->data['property_status'] = $property_status;

        $this->merit_model->setSelectFields(array('id', 'inspection_type'));
        $inspection_type = $this->merit_model->getInfo($site . '.tbl_inspection_type');
        $this->data['inspection_type'] = $inspection_type;

        $this->merit_model->setSelectFields(array('id', 'orientation'));
        $o = $this->merit_model->getInfo($site . '.tbl_report_orientation');

        $orientation = array();
        if(count($o) > 0){
            foreach ($o as $v) {
                $orientation[$v->id] = $v->orientation;
            }
        }
        $this->data['orientation'] = $orientation;

        if($id){
            $this->main_model->setShift();
            $fld = ArrayWalk($this->main_model->getFields('tbl_job_registration'),'tbl_job_registration.');
            $fld[] = 'IF(date_entered,DATE_FORMAT(date_entered,"%d-%m-%Y"),"") as date_entered';
            $fld[] = 'IF(date_completed,DATE_FORMAT(date_completed,"%d-%m-%Y"),"") as date_completed';
            $fld[] = 'IF(date_report_printed,DATE_FORMAT(date_report_printed,"%d-%m-%Y"),"") as date_report_printed';
            $fld[] = 'IF(inspection_time,DATE_FORMAT(inspection_time,"%a %d-%m-%Y %h:%i %p"),"") as inspection_time';
            $fld[] = 'IF(date_due,DATE_FORMAT(date_due,"%a %d-%m-%Y %h:%i %p"),"") as date_due';
            $fld[] = 'IF(date_report_sent,DATE_FORMAT(date_report_sent,"%d-%m-%Y"),"") as date_report_sent';
            $this->main_model->setSelectFields($fld);
            $job = (object) $this->main_model->getinfo('tbl_job_registration',$id);
            $job->link = base_url() . 'inspectionReport/' . $job->id;
            $job->inspection_link = base_url() . 'onSiteVisit/' . $job->id . '?menu_id=1';
            $job_history = $this->main_model->getinfo('tbl_job_history',$id,'job_id');
            $this->data['job'] = $job;
            $this->data['job_history'] = $job_history;

            $this->main_model->setShift();
            $job_inspection = (object) $this->main_model->getinfo('tbl_job_inspection',$id,'job_id');
            $this->data['job_inspection'] = $job_inspection;

            $_job = new Job_Helper();
            $inspection_report = array_shift($_job->jobDetails($job->id));
            $this->data['inspection_report'] = $inspection_report;

            $job_photos = $this->main_model->getinfo('tbl_job_photos',$id,'job_id');
            $this->data['job_photos'] = $job_photos;
            $this->data['_pageTitle'] = 'Job Registration - Edit (' . $job->project_name . ')';

            $this->main_model->setShift();
            $_fld = ArrayWalk($this->main_model->getFields('tbl_job_registration',array('id')),'tbl_job_registration.');
            $_fld[] = 'IF(date_entered,date_entered,"") as date_entered';
            $_fld[] = 'IF(date_completed,date_completed,"") as date_completed';
            $_fld[] = 'IF(date_report_printed,date_report_printed,"") as date_report_printed';
            $_fld[] = 'IF(inspection_time,inspection_time,"") as inspection_time';
            $_fld[] = 'IF(date_due,date_due,"") as date_due';

            $this->main_model->setSelectFields($_fld);
            $job_data = $this->main_model->getInfo('tbl_job_registration',$id);

            $notes = $this->my_model->getinfo('tbl_job_history',$id,'job_id');
            $this->data['notes'] = $notes;

            $this->merit_model->setJoin(array(
                'table' => array('tbl_items','tbl_unit_conversion'),
                'join_field' => array('id','id'),
                'source_field' => array('tbl_job_estimate.item_id','tbl_items.unit_id'),
                'type' => 'left'
            ));
            $fields = ArrayWalk($this->merit_model->getFields('tbl_items',['id']),'tbl_items.');
            $fields[] = 'tbl_job_estimate.id';
            $fields[] = 'tbl_unit_conversion.unit_from';
            $fields[] = 'tbl_job_estimate.item_id';
            $fields[] = 'tbl_job_estimate.job_id';
            $fields[] = 'tbl_job_estimate.quantity';
            $fields[] = 'tbl_job_estimate.cost';
            $this->merit_model->setSelectFields($fields);
            $estimate = $this->merit_model->getinfo('tbl_job_estimate',$id,'job_id');
            $this->data['estimate'] = $estimate;

            $this->merit_model->setJoin(array(
                'table' => array('tbl_unit_conversion'),
                'join_field' => array('id'),
                'source_field' => array('tbl_items.unit_id'),
                'type' => 'left'
            ));
            $fields = ArrayWalk($this->merit_model->getFields('tbl_items'),'tbl_items.');
            $fields[] = 'tbl_unit_conversion.unit_from';
            $this->merit_model->setSelectFields($fields);
            $estimate = $this->merit_model->getinfo('tbl_items',1,'auto_item');
            $this->data['auto_items'] = $estimate;

            $whatVal = '';
            $whatFld = '';
            if($this->uri->segment(2)){
                $whatVal = $this->uri->segment(2);
                $whatFld = 'job_id';
            }
            $defects = $this->merit_model->getInfo($site . '.tbl_defects',$whatVal,$whatFld);
            $rooms = array();
            if(count($defects) > 0){
                foreach ($defects as $v) {
                    $dir = json_decode($v->dir);
                    $files = array();
                    if(count($dir) > 0){
                        foreach ($dir as $file) {
                            $files[] = "defects/" . $v->id . "/" . $file;
                        }
                    }
                    $v->dir = $files;
                    if($v->room_id){
                        $rooms[] =  $v->room_id;
                    }
                }
            }
            $this->data['defects'] = $defects;
            $this->data['rooms'] = $rooms;
        }

        if($type && $history_id){
            $this->main_model->delete('tbl_job_history',$history_id);
        }

        $registration_fld = $this->main_model->getFields('tbl_job_registration',array('id'));

        $this->merit_model->setShift();
        $this->data['conclusion'] = (object)$this->merit_model->getInfo('tbl_job_inspection',$id,'job_id');
        //region POST
        //region Submit Job Details
        if(isset($_POST['submit_details'])){
            unset($_POST['submit_details']);
            $history = isset($_POST['history']) ? $_POST['history'] : array();
            $history_date = isset($_POST['history_date']) ? $_POST['history_date'] : array();
            unset($_POST['history']);
            unset($_POST['history_date']);

            $_id = 0;
            $_post = array();
            if(count($registration_fld) > 0) {
                foreach($registration_fld as $k=>$v){
                    if(array_key_exists($v,$_POST)){
                        $_post[$v] = $_POST[$v];
                        unset($_POST[$v]);
                    }
                }
            }

            if(isset($_post['project_name'])){
                if(count($_post) > 0){
                    foreach($_post as $key=>$val){
                        if($val && (strpos($key, 'date') !== false || strpos($key, 'time') !== false)){
                            $_post[$key] = date('Y-m-d H:i:s',strtotime($val));
                        }
                    }
                }

                if($id){
                    $p = $_post;
                    $l = new Controller_Logger();
                    $l->tracking_change_logger($p, '', $id, 2);

                    $n = new Job_Helper();
                    $n->setJobNotification($id,'updated');

                    $this->main_model->update('tbl_job_registration',$_post,$id,'id',false);
                }
                else{
                    $_id = $this->main_model->insert('tbl_job_registration',$_post,false);

                    $p = $_POST;
                    $l = new Controller_Logger();
                    $l->tracking_change_logger($p, '', $_id, 1);

                    $n = new Job_Helper();
                    $n->setJobNotification($_id,'created');
                }
            }

            $job_id = $id ? $id : $_id;
            if(count($history) > 0){
                foreach($history as $k=>$v){
                    if($v){
                        $post = array(
                            'job_id' => $job_id,
                            'date_time' => date('Y-m-d H:i:s',strtotime($history_date[$k])),
                            'history' => $v,
                            'user_id' => $this->session->userdata('userID')
                        );

                        if($id){
                            $_data = $this->main_model->getinfo('tbl_job_history',$k);
                            if(count($_data) > 0){
                                $this->main_model->update('tbl_job_history',$post,$k,'id',false);
                                $p = array_merge($post,$job_data);
                                $l = new Controller_Logger();
                                $l->tracking_change_logger($p, 'tbl_job_history', $job_id, 2);

                                $n = new Job_Helper();
                                $n->setJobNotification($id,'Notes updated',false);
                            }
                            else{
                                $this->main_model->insert('tbl_job_history',$post,false);
                                $p = array_merge($post,$job_data);
                                $l = new Controller_Logger();
                                $l->tracking_change_logger($p, 'tbl_job_history', $job_id, 1);

                                $n = new Job_Helper();
                                $n->setJobNotification($id,'new Note created',false);
                            }
                        }
                        else{
                            $this->main_model->insert('tbl_job_history',$post,false);
                            $p = array_merge($post,$job_data);
                            $l = new Controller_Logger();
                            $l->tracking_change_logger($p, 'tbl_job_history', $job_id, 1);

                            $n = new Job_Helper();
                            $n->setJobNotification($id,'new Note created',false);
                        }
                    }
                }
            }

            if(isset($_post['inspector_id'])){
                $whatFld = array('UserID','TrackID');
                $whatVal = array($_POST['inspector_id'],$job_id);
                $user_assignment = $this->my_model->getinfo('tbl_user_assignment',$whatVal,$whatFld);

                if(count($user_assignment) > 0){
                    foreach($user_assignment as $val){
                        $post = array(
                            'UserID' => $_POST['inspector_id'],
                            'TrackID' => $job_id,
                            'InspectionDate' => date('Y-m-d H:i:s',strtotime($_POST['inspection_time'])),
                            'InspectionTime' => date('h:i A',strtotime($_POST['inspection_time']))
                        );
                        $this->my_model->update('tbl_user_assignment',$post,$val->id,'id',false);
                    }
                }
                else{
                    $post = array(
                        'UserID' => $_POST['inspector_id'],
                        'TrackID' => $job_id,
                        'ClientSchedule' => date('Y-m-d'),
                        'DateAssigned' => date('Y-m-d'),
                        'InspectionDate' => date('Y-m-d H:i:s',strtotime($_POST['inspection_time'])),
                        'InspectionTime' => date('h:i A',strtotime($_POST['inspection_time']))
                    );

                    $this->my_model->insert('tbl_user_assignment',$post);
                }
            }

            //region Submit Job Inspection
            if(isset($_POST['roof_type_id']) && $id){
                $post = [
                    'job_id' => $id,
                    'roof_type_id' => $_POST['roof_type_id'],
                    'roof_design_id' => $_POST['roof_design_id'],
                    'roof_pitch' => $_POST['roof_pitch'],
                    'roof_age' => $_POST['roof_age'],
                    'roof_cladding_finish_id' => $_POST['roof_cladding_finish_id'],
                    'roof_cladding_condition_id' => $_POST['roof_cladding_condition_id'],
                    'fascia_type_id' => $_POST['fascia_type_id'],
                    'flashing_type_id' => $_POST['flashing_type_id'],
                    'spouting_type_id' => $_POST['spouting_type_id'],
                    'insulation_id' => $_POST['insulation_id'],
                    'client_discussions' => $_POST['client_discussions'],
                    'damage_sighted' => $_POST['damage_sighted'],
                    'repair_strategy' => $_POST['repair_strategy'],
                    'overview' => $_POST['overview'],
                ];
                $has_job_inspection = $this->main_model->getinfo('tbl_job_inspection',$id,'job_id');
                if(count($has_job_inspection) > 0){
                    foreach($has_job_inspection as $k=>$v){
                        $this->main_model->update('tbl_job_inspection',$post,$v->id,'id',false);
                        $p = array_merge($job_data,$post);
                        $l = new Controller_Logger();
                        $l->tracking_change_logger($p, 'tbl_job_inspection', $id, 2);

                        $n = new Job_Helper();
                        $n->setJobNotification($id,'Job Inspection details updated',false);
                    }
                }
                else{
                    $this->main_model->insert('tbl_job_inspection',$post,false);
                    $p = array_merge($job_data,$post);
                    $l = new Controller_Logger();
                    $l->tracking_change_logger($p, 'tbl_job_inspection', $id, 1);

                    $n = new Job_Helper();
                    $n->setJobNotification($id,'Job Inspection details created',false);
                }

                $url = 'jobRegistration';
                $url .= $id ? '?id=' . $id .'' : '';
                redirect($url);
            }
            //endregion

            //region Upload Photo
            if(isset($_GET['upload'])){
                if(!empty($_FILES)) {
                    $uploadDir = realpath(APPPATH . '../uploads');
                    $uploadDir .= '/job/'. $id .'/photos';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, TRUE);
                    }

                    if(count($_FILES['file_attachment']['name']) > 0){
                        foreach($_FILES['file_attachment']['name'] as $key=>$files){
                            $file_name = $files;
                            $file      = $uploadDir . '/' . $file_name;

                            $is_exist = $this->my_model->getInfo('tbl_job_photos',$file_name,'photo_name');

                            if (move_uploaded_file($_FILES['file_attachment']['tmp_name'][$key], $file)) {
                                $post = array(
                                    'photo_name' => $file_name,
                                    'job_id' => $id,
                                    'uploader_id' => $this->session->userdata('user_id'),
                                    'date' => date('Y-m-d H:i:s')
                                );

                                if(count($is_exist) > 0){
                                    foreach($is_exist as $v){
                                        $this->my_model->update('tbl_job_photos',$post,$v->id,'id',false);
                                        $p = array_merge($post,$job_data);
                                        $l = new Controller_Logger();
                                        $l->tracking_change_logger($p, 'tbl_job_photos', $id, 2);

                                        $n = new Job_Helper();
                                        $n->setJobNotification($id,'Photo updated',false);
                                    }
                                }else{
                                    $p = array_merge($post,$job_data);
                                    $l = new Controller_Logger();
                                    $l->tracking_change_logger($p, 'tbl_job_photos', $id, 1);
                                    $this->my_model->insert('tbl_job_photos',$post,false);

                                    $n = new Job_Helper();
                                    $n->setJobNotification($id,'Photo uploaded',false);
                                }
                            }
                        }
                    }

                }
                //region Submit Photo Comment
                if(isset($_POST['submit_comments'])){
                    if(count($_POST['comments']) > 0){
                        foreach($_POST['comments'] as $key=>$val){
                            $post = array(
                                'comment' => $val
                            );
                            $this->main_model->update('tbl_job_photos',$post,$key,'id',false);

                            $p = array_merge($job_data,$_POST);
                            $l = new Controller_Logger();
                            $l->tracking_change_logger($p, 'tbl_job_photos', $id, 2);

                            $n = new Job_Helper();
                            $n->setJobNotification($id,"Photo's comment updated.",false);
                        }
                    }
                }
                //endregion
            }
            //endregion

            //region Create Initial Inspection Report to DB
            $has_inspection_report = $this->merit_model->getInfo('tbl_site_inspection_report',$job_id,'job_id');
            $post = array('job_id' => $job_id);
            if(count($has_inspection_report) > 0){
                foreach($has_inspection_report as $val){
                    $this->merit_model->update('tbl_site_inspection_report',$post,$val->id);
                }
            }
            else{
                $this->merit_model->insert('tbl_site_inspection_report',$post);
            }

            //endregion
            $url = 'jobRegistration';
            $url .= $id ? '?id=' . $id .'' : '';
            redirect($url);
        }
        //endregion
        //region Submit Estimates
        if(isset($_POST['submit_estimate'])){
            $_id = isset($_GET['id']) ? $_GET['id'] : '';
            //new estimate to be added
            $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : [];
            $item_id = isset($_POST['item_id']) ? $_POST['item_id'] : [];
            $cost = isset($_POST['cost']) ? $_POST['cost'] : [];
            //update estimate to be added
            $_quantity = isset($_POST['_quantity']) ? $_POST['_quantity'] : [];
            $_item_id = isset($_POST['_item_id']) ? $_POST['_item_id'] : [];
            $_cost = isset($_POST['_cost']) ? $_POST['_cost'] : [];

            if(count($item_id) > 0){
                foreach($item_id as $key=>$val){
                    $post = [
                        'item_id' => $val,
                        'quantity' => $quantity[$key],
                        'cost' => $cost[$key],
                        'job_id' => $_id
                    ];
                    $this->merit_model->insert('tbl_job_estimate',$post);
                }

            }
            if(count($_item_id) > 0){
                foreach($_item_id as $key=>$val){
                    $post = [
                        'item_id' => $val,
                        'quantity' => $_quantity[$key],
                        'cost' => $_cost[$key],
                    ];

                    $this->merit_model->update('tbl_job_estimate',$post,$key);
                }
            }

            $this->main_model->setJoin(array(
                'table' => array('tbl_items'),
                'join_field' => array('id'),
                'source_field' => array('tbl_job_estimate.item_id'),
                'type' => 'left'
            ));
            $fld = ArrayWalk($this->main_model->getFields('tbl_items',array('id')),'tbl_items.');
            $fld[] = 'IF(tbl_items.auto_item, "Yes","") as auto_item_status';
            $fld[] = 'tbl_job_estimate.id';
            $fld[] = 'tbl_job_estimate.item_id';
            $fld[] = 'tbl_job_estimate.quantity';
            $fld[] = 'tbl_job_estimate.cost';
            $fld[] = 'tbl_job_estimate.job_id';

            $this->main_model->setSelectFields($fld);
            $items_list = $this->main_model->getInfo('tbl_job_estimate',$_id,'job_id');

            echo json_encode($items_list);
            exit;
        }
        if(isset($_GET['delete'])){
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            if($id){
                $this->merit_model->delete('tbl_job_estimate',$id);
            }
        }
        //endregion

        //endregion
        
        $array = array();
        $dropdown = $this->main_model->getinfo('tbl_job_type_specs');
        if(count($dropdown) > 0){
            foreach($dropdown as $k=>$v){
                if($v->job_type_id != 10){
                    $array[$v->job_type_id][''] = '-';
                }
                $array[$v->job_type_id][$v->id] = $v->job_type_specs;
            }
        }
        $this->data['drop_down'] = $array;

        if($link){
            $this->main_model->setSelectFields(array('id','CONCAT(FName," ",LName) as name','AccountType','isQualifiedInspector'));
            $accounts = $this->main_model->getinfo('tbl_user');
            $inspector = array();
            $accounts_array = array();

            if(count($accounts) > 0){
                foreach($accounts as $k=>$v){

                    @$inspector[''] = '-';

                    if($v->AccountType != 4){
                        $accounts_array[''] = '-';
                        $accounts_array[$v->id] = $v->name;
                    }
                    if($v->AccountType == 4 || $v->isQualifiedInspector){
                        $inspector[$v->id] = $v->name;
                    }
                }
            }

            $this->data['inspector'] = @$inspector;
            $this->data['accounts'] = $accounts_array;

            $file_name = 'project_' . $link . '_view.php';
            $file_name_array = get_filenames('application/views/project/tabs');
            if(count($_POST) == 0 && in_array($file_name,$file_name_array)){
                $this->load->view('project/tabs/' . $file_name,$this->data);
            }
        }
        else if(isset($_POST['tab'])){
            $this->session->set_userdata(array('_link' => $_POST['tab']));
        }
        else{
            $this->data['_pageLoad'] = 'project/project_management_view';
            $this->load->view('main_view',$this->data);
        }
    }

    function trackingLog(){
        $this->load->helper('directory');
        $account_type = $this->data['accountType'];
        $user_id = $this->data['_userID'];
        $inspector_id = $account_type == 4 ? $user_id : '';
        $job_details = new Job_Helper();
        $this->data['tracking'] = $job_details->jobDetails('',$inspector_id,true);
        $path = realpath(APPPATH.'../pdf/inspection_report');
        if(count($this->data['tracking']) > 0){
            foreach($this->data['tracking'] as $v){
                $v->report_file = '';
                if(file_exists($path.'/'.$v->id)){
                    $dir_map = directory_map($path.'/'.$v->id);
                    if(count($dir_map) > 0){
                        sort($dir_map);
                        $v->report_file = end($dir_map);
                    }
                }
            }
        }
        $this->data['_pageLoad'] = 'track/tracking_log_view';
        $this->load->view('main_view',$this->data);
    }

    function deleteJobPhoto(){
        $id = $this->uri->segment(2);

        if(!$id){
            exit;
        }
        $this->main_model->setShift();
        $file = (Object)$this->main_model->getInfo('tbl_job_photos',$id);
        $base_dir = realpath(APPPATH.'../uploads/job/'.$file->job_id.'/photos');
        $file_path = $base_dir . '/' . $file->photo_name;

        if(file_exists($file_path)){
            unlink($file_path);
            $this->main_model->delete('tbl_job_photos',$id);
        }
    }

    function generateJobReport(){
        $job_id = $this->uri->segment(2);

        if(!$job_id){
            exit;
        }

        $job_details = new Job_Helper();
        $job = $job_details->jobDetails($job_id);
        $this->data['job_details'] = $job;

        if(isset($_POST['submit'])){
            $report = $this->merit_model->getInfo('tbl_job_inspection',$job_id,'job_id');
            $post = ['report_conclusion' => $_POST['report_conclusion'],'job_id' => $job_id];
            if(count($report) > 0){
                foreach($report as $val){
                    $this->merit_model->update('tbl_job_inspection',$post,$val->id);
                }
            }
            else{
                $this->merit_model->insert('tbl_job_inspection',$post);
            }
        }

        if(count($job) > 0){
            foreach($job as $val){
                if($val->job_type_id != 64){
                    if(isset($_GET['v']) && $_GET['v'] == 1){
                        $this->load->view('project/report/generate_report_pdf_view',$this->data);
                    }
                    else {
                        $this->load->view('project/report/generate_report_view', $this->data);
                    }
                }
                else{
                    redirect('inspectionReport?is_print=1&job=' . $job_id . '&view=1');
                }
            }
        }
    }

    function jobNotes(){
        $job_id = $this->uri->segment(2);
        if(!$job_id){
            exit;
        }

        if(isset($_POST['submit'])){
            $this->main_model->setShift();
            $_fld = ArrayWalk($this->main_model->getFields('tbl_job_registration',array('id')),'tbl_job_registration.');
            $_fld[] = 'IF(date_entered,date_entered,"") as date_entered';
            $_fld[] = 'IF(date_completed,date_completed,"") as date_completed';
            $_fld[] = 'IF(date_report_printed,date_report_printed,"") as date_report_printed';
            $_fld[] = 'IF(inspection_time,inspection_time,"") as inspection_time';
            $_fld[] = 'IF(date_due,date_due,"") as date_due';

            $this->main_model->setSelectFields($_fld);
            $job_data = $this->main_model->getInfo('tbl_job_registration',$job_id);

            $history = $_POST['history'];
            $history_date = $_POST['history_date'];
            $post = array();
            if(count($history) > 0){
                foreach($history as $k=>$v){
                    if($v){
                        $post = array(
                            'job_id' => $job_id,
                            'date_time' => date('Y-m-d H:i:s',strtotime($history_date[$k])),
                            'history' => $v,
                            'user_id' => $this->session->userdata('userID')
                        );
                        if($job_id){
                            $_data = $this->main_model->getinfo('tbl_job_history',$k);
                            if(count($_data) > 0 && $k != 0){
                                $this->main_model->update('tbl_job_history',$post,$k,'id',false);
                            }
                            else{
                                $this->main_model->insert('tbl_job_history',$post,false);
                            }
                        }
                        else{
                            $this->main_model->insert('tbl_job_history',$post,false);
                        }
                    }
                }
            }
            $p = array_merge($post,$job_data);
            $l = new Controller_Logger();
            $l->tracking_change_logger($p, 'tbl_job_history', $job_id, 2);

            $n = new Job_Helper();
            $n->setJobNotification($job_id,'new Note created',false);

            redirect((isset($_GET['is_form']) ? 'jobRegistration?id=' . $job_id : 'trackingLog'));
        }

        if(isset($_GET['is_review'])){
            $this->merit_model->setJoin(array(
                'table' => array('tbl_user'),
                'join_field' => array('ID'),
                'source_field' => array('tbl_job_history.user_id'),
                'type' => 'left'
            ));
            $fld = ArrayWalk($this->merit_model->getFields('tbl_job_history'),'tbl_job_history.');
            $fld[] = 'CONCAT(tbl_user.FName," ",tbl_user.LName) as author_name';

            $this->merit_model->setSelectFields($fld);
            $this->merit_model->setOrder('date_time','DESC');
            $notes = $this->merit_model->getInfo('tbl_job_history',$job_id,'job_id');
            $this->data['notes'] = $notes;

            $this->load->view('project/notes/job_notes_view',$this->data);
        }
        else{
            $this->load->view('project/notes/add_notes_view',$this->data);
        }
    }

    function inspectionReport(){
        $job_id = isset($_GET['job']) ? $_GET['job'] : $this->uri->segment(2);
        $this->load->helper('directory');
        $this->main_model->setSelectFields(array(
            'id','CONCAT(LPAD(id,5,0)," (", project_name ,")") as job_name'
        ));
        $account_type = $this->data['accountType'];
        $user_id = $this->data['_userID'];
        $whatVal = $account_type == 4 ? $user_id : '';
        $whatFld = $account_type == 4 ? 'inspector_id' : '';
        $this->main_model->setNormalized('job_name','id');
        $this->data['job_number'] = $this->main_model->getinfo('tbl_job_registration',$whatVal,$whatFld);
        $this->data['job_number'][''] = '-';
        ksort($this->data['job_number']);

        $this->main_model->setJoin(array(
            'table' => array('tbl_site_inspection'),
            'join_field' => array('id'),
            'source_field' => array('tbl_site_inspection_type.inspection_type_id'),
            'type' => 'left'
        ));
        $fld = ArrayWalk($this->main_model->getFields('tbl_site_inspection_type'),'tbl_site_inspection_type.');
        $fld[] = 'tbl_site_inspection.site_inspection_type';
        $this->main_model->setSelectFields($fld);

        $site_inspection = $this->main_model->getinfo('tbl_site_inspection_type');
        $area_inspected = $this->main_model->getInfo('tbl_area_inspected');
        $_data = array();
        if(count($site_inspection) > 0){
            foreach($site_inspection as $key=>$val){
                $_data[$val->site_inspection_type][] = $val;
            }
        }
        $this->data['site_inspection'] = $_data;
        $this->data['area_inspected'] = $area_inspected;

        $this->main_model->setJoin(array(
            'table' => array('tbl_job_registration','tbl_user'),
            'join_field' => array('id','id'),
            'source_field' => array('tbl_site_inspection_report.job_id','tbl_job_registration.inspector_id'),
            'type' => 'left'
        ));
        $job_details = ArrayWalk($this->main_model->getFields('tbl_job_registration'),'tbl_job_registration.');
        $site_inspection = ArrayWalk($this->main_model->getFields('tbl_site_inspection_report',array('id')),'tbl_site_inspection_report.');
        $fld = array_merge($job_details,$site_inspection);
        $fld[] = 'CONCAT(tbl_user.FName," ",tbl_user.LName) as inspector';
        $fld[] = 'IF(tbl_user.Tel != "-" AND tbl_user.Tel != "",tbl_user.Mobile,tbl_user.Tel) as inspector_contact';
        $this->main_model->setSelectFields($fld);
        $this->main_model->setShift();
        $this->data['inspection_report'] = (Object)$this->main_model->getInfo('tbl_site_inspection_report',$job_id,'job_id');
        @$this->data['inspection_report']->conclusion = json_decode(@$this->data['inspection_report']->conclusion);
        @$this->data['inspection_report']->notes = json_decode(@$this->data['inspection_report']->notes);

        if(isset($_POST['generate'])){
            unset($_POST['generate']);
            unset($_POST['history_date']);
            unset($_POST['history']);
            $_POST['user_id'] = $user_id;
            $_POST['conclusion'] = count($_POST['conclusion']) > 0 ? json_encode($_POST['conclusion']) : '';
            $_POST['notes'] = count($_POST['notes']) > 0 ? json_encode($_POST['notes']) : '';
            //region Upload Photo
            if(isset($_FILES['photo'])){
                if(!empty($_FILES)) {
                    $uploadDir = realpath(APPPATH . '../uploads');
                    $uploadDir .= '/job/'. $_POST['job_id'] .'/photos';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, TRUE);
                    }

                    $file_name = $_FILES['photo']['name'];
                    $file      = $uploadDir . '/' . $file_name;

                    if (move_uploaded_file($_FILES['photo']['tmp_name'], $file)) {
                        $_POST['photo'] = $file_name;
                        $_POST['is_generated'] = 1;
                    }

                }
            }
            //endregion
            if($_POST['job_id']){
                $is_exists = $this->merit_model->getInfo('tbl_site_inspection_report',$_POST['job_id'],'job_id');
                if(count($is_exists) > 0){
                    foreach($is_exists as $key=>$val){
                        $this->merit_model->update('tbl_site_inspection_report',$_POST,$val->id,'id',false);
                    }
                }
                else{
                    $this->merit_model->insert('tbl_site_inspection_report',$_POST,false);
                }
            }
            redirect('jobRegistration?id=' . $this->uri->segment(2));
        }
        else if(isset($_GET['is_print']) && isset($_GET['job'])){
            $dir = realpath(APPPATH.'../pdf/inspection_report');

            $this->data['save_path'] = $dir . '/' . $_GET['job'] . '/';

            if(!is_dir($this->data['save_path'])){
                mkdir($this->data['save_path'], 0777, TRUE);
            }
            $post['is_generated'] = 1;
            $_POST['user_id'] = $user_id;
            $this->merit_model->update('tbl_site_inspection_report',$post,$_GET['job'],'job_id',false);

            $this->load->view('project/report/inspection_report_pdf',$this->data);
        }
        if(isset($_GET['job']) && $_GET['job']){
            $_job_id = $_GET['job'];
            $job = new Job_Helper();
            $_job = $job->jobDetails($_job_id);

            echo json_encode($_job);
        }
        else if(isset($_GET['email'])){
            $this->load->view('project/report/email_setup_view',$this->data);
        }
        else if(isset($_GET['r'])){
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $path = realpath(APPPATH.'../pdf/inspection_report');
            $_file = '';
            if(file_exists($path.'/'.$id)){
                $dir_map = directory_map($path.'/'.$id);
                if(count($dir_map) > 0){
                    sort($dir_map);
                    $_file = end($dir_map);
                }
            }
            $this->data['_file'] = $_file;
            $this->data['_id'] = $id;
            $this->data['_pageTitle'] .= ' - Review';
            $this->data['_pageLoad'] = 'project/report/inspection_report_review';
            $this->load->view('main_view',$this->data);
        }
        else{
            if(isset($_GET['tag'])){
                $this->main_model->setNormalized('description','text');
                $this->main_model->setSelectFields(array('description',"REPLACE(text,'\"',\"'\") as text"));
                $this->data['tags'] = $this->main_model->getInfo('tbl_tags');
                $this->data['tags'][''] = '-';
                ksort($this->data['tags']);
                $this->load->view('project/report/add_tag_view',$this->data);
            }
            else{
                $this->load->view('project/report/inspection_report_view',$this->data);
            }
        }
    }

    function tag(){

        $this->data['_pageLoad'] = 'tags/tag_view';

        $isPrint = isset($_GET['isPrint']) ? $_GET['isPrint'] : 0;
        $incld = isset($_GET['incld']) ? $_GET['incld'] : '';
        $xcld = isset($_GET['xcld']) ? $_GET['xcld'] : '';
        $fId = isset($_GET['fId']) ? $_GET['fId'] : '';

        $whatField = array();
        $whatVal = array();
        if($incld){
            $incldVal = array_filter(array_unique(explode(" ", strtolower($incld))));
            $incldArray1 = ArrayWalk(ArrayWalk($incldVal, "tbl_tags.tag_id LIKE '%"), "%'", 'back');
            $incldArray2 = ArrayWalk(ArrayWalk($incldVal, "tbl_tags.description LIKE '%"), "%'", 'back');
            $incldArray = array_merge($incldArray1, $incldArray2);
            $incldString = "(" . implode(" OR ", $incldArray) . ")";

            $whatField[] = '';
            $whatVal[] = $incldString;
        }
        if($xcld){
            $xcldVal = array_filter(array_unique(explode(" ", strtolower($xcld))));
            $xcldArray1 = ArrayWalk(ArrayWalk($xcldVal, "tbl_tags.tag_id NOT LIKE '%"), "%'", 'back');
            $xcldArray2 = ArrayWalk(ArrayWalk($xcldVal, "tbl_tags.description NOT LIKE '%"), "%'", 'back');
            $xcldArray = array_merge($xcldArray1, $xcldArray2);
            $xcldString = "(" . implode(" AND ", $xcldArray) . ")";

            $whatField[] = '';
            $whatVal[] = $xcldString;
        }

        $fields = ArrayWalk($this->main_model->getFields('tbl_tags'), 'tbl_tags.');
        $this->main_model->setSelectFields($fields);
        $this->main_model->setOrder(array('tbl_tags.franchise_id', 'tbl_tags.seq'));
        $tags = $this->main_model->getInfo('tbl_tags', $whatVal, $whatField);

        $this->data['franchise'] = array('' => 'Select Franchise');

        $this->data['activeId'] = isset($_GET['id']) ? $_GET['id'] : "";

        if($isPrint){
            $this->data['tags'] = $tags;
            $this->load->view('tags/tag_print_view', $this->data);
        }
        else{
            $this->data['tags'] = json_encode($tags);
            $this->load->view('main_view', $this->data);
        }
    }

    function tagAdd(){

        if(isset($_POST['submit'])){
            unset($_POST['submit']);

            $this->main_model->setOrder('seq');
            $this->main_model->setLastId('seq');
            $_POST['seq'] = $this->main_model->getInfo('tbl_tags') + 1;

            $_POST['description'] = nl2br($_POST['description']);
            $_POST['text'] = nl2br($_POST['text']);
            $id = $this->main_model->insert('tbl_tags', $_POST, false);

            /*$post = array(
                'update_type' => 1,
                'user_id' => $this->session->userdata('id'),
                'page_id' => 348,
                'tbl_name' => 'tbl_tags',
                'to' => json_encode($_POST)
            );
            $this->main_model->insert('tbl_system_audit_log', $post, false);*/

            $thisUrl = 'tag?id=' . $id;
            redirect($thisUrl);
        }

        $this->data['franchise'] = array('' => 'Select Franchise');

        $this->load->view('tags/tag_add_view', $this->data);
    }

    function tagEdit(){
        
        $whatId = $this->uri->segment(2);
        if(!$whatId){
            exit;
        }

        $fields = ArrayWalk($this->main_model->getFields('tbl_tags'), 'tbl_tags.');
        $this->main_model->setSelectFields($fields);
        $this->main_model->setShift();
        $tag = (Object)$this->main_model->getInfo('tbl_tags', $whatId, 'tbl_tags.id');

        if(isset($_POST['submit'])){
            unset($_POST['submit']);

            $_POST['description'] = nl2br($_POST['description']);
            $_POST['text'] = nl2br($_POST['text']);
            $this->main_model->update('tbl_tags', $_POST, $whatId, 'id', false);

            /*$post = array(
                'update_type' => 2,
                'user_id' => $this->session->userdata('id'),
                'page_id' => 348,
                'tbl_name' => 'tbl_tags',
                'from' => json_encode($tag),
                'to' => json_encode($_POST)
            );
            $this->main_model->insert('tbl_system_audit_log', $post, false);*/

            $thisUrl = 'tag?id=' . $whatId;
            redirect($thisUrl);
        }
        $this->data['tag'] = $tag;

        $this->data['franchise'] = array('' => 'Select Franchise');

        $this->load->view('tags/tag_edit_view', $this->data);
    }

    function tagDelete(){
        

        $whatId = isset($_POST['id']) ? $_POST['id'] : '';
        if(!$whatId){
            exit;
        }

        $this->main_model->setSelectFields(array('CONCAT("<strong>", tag_id, "</strong> - ", description) as tags'));
        $this->main_model->setNormalized('tags');
        $tags = $this->main_model->getInfo('tbl_tags', $whatId);

        $this->main_model->delete('tbl_tags', $whatId);

        /*$post = array(
            'update_type' => 3,
            'user_id' => $this->session->userdata('id'),
            'page_id' => 348,
            'tbl_name' => 'tbl_tags',
            'from' => json_encode($tags)
        );
        $this->main_model->insert('tbl_system_audit_log', $post, false);*/
    }
}