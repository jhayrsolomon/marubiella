<?php
    $dashboard = 'hidden';
    $osr = 'hidden';
    $junior = 'hidden';
    $leader = 'hidden';
    $manager = 'hidden';
    $csr = 'hidden';
    $encoder = 'hidden';
//    $sosr = 'hidden';
//    $add_sales = 'hidden';
//    $report = 'hidden';
//    $monitoring = 'hidden';
//    $junior = 'hidden';
//    $jun_add_sales = 'hidden';
//    $jun_report = 'hidden';
//    $jun_monitoring = 'hidden';
//    $leader = 'hidden';
//    $lead_add_sales = 'hidden';
//    $lead_report = 'hidden';
//    $lead_monitoring = 'hidden';
//    $manager = 'hidden';
//    $man_add_sales = 'hidden';
//    $man_report = 'hidden';
//    $man_monitoring = 'hidden';
//    $scsr = 'hidden';
//    $csr_verify_sales = 'hidden';
//    $csr_add_sales = 'hidden';
//    $csr_report = 'hidden';
//    $csr_monitoring = 'hidden';
//    $encoder = 'hidden';
//    $enc_verify_sales = 'hidden';
//    $enc_add_sales = 'hidden';
//    $enc_report = 'hidden';
//    $enc_monitoring = 'hidden';

    $permissions = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id);
    foreach($permissions as $dash){
        if($dash->name == '/sales/dashboard/*')
        {
            $dashboard = '';
            break;
        }
    }

    foreach($permissions as $o){
        if($o->name == '/sales/osr/*')
        {
            $osr = '';
            break;
        }
    }

    foreach($permissions as $jun){
        if($jun->name == '/sales/junior-leader/*')
        {
            $junior = '';
            break;
        }
    }

    foreach($permissions as $lead){
        if($lead->name == '/sales/leader/*')
        {
            $leader = '';
            break;
        }
    }
    
    foreach($permissions as $man){
        if($man->name == '/sales/manager/*')
        {
            $manager = '';
            break;
        }
    }

    foreach($permissions as $c){
        if($c->name == '/sales/csr/*')
        {
            $csr = '';
            break;
        }
    }

    foreach($permissions as $enc){
        if($enc->name == '/sales/encoder/*')
        {
            $encoder = '';
            break;
        }
    }
    /*foreach($permissions as $osr){
        if($osr->name == '/sales/osr/add-sales' || $osr->name == '/sales/osr/view-sales' || $osr->name == '/sales/osr/view-report')
        {
            $sosr = '';
            break;
        }
    }

    foreach($permissions as $add){
        if($add->name == '/sales/osr/add-sales')
        {
            $add_sales = '';
            break;
        }
    }

    foreach($permissions as $rep){
        if($rep->name == '/sales/osr/view-report')
        {
            $report = '';
            break;
        }
    }
    
    foreach($permissions as $mon){
        if($mon->name == '/sales/osr/view-sales')
        {
            $monitoring = '';
            break;
        }
    }

    foreach($permissions as $jun){
        if($jun->name == '/sales/junior-leader/add-sales' || $jun->name == '/sales/junior-leader/view-sales' || $jun->name == '/sales/junior-leader/view-report')
        {
            $junior = '';
            break;
        }
    }

    foreach($permissions as $jun_add){
        if($jun_add->name == '/sales/junior-leader/add-sales')
        {
            $jun_add_sales = '';
            break;
        }
    }

    foreach($permissions as $jun_rep){
        if($jun_rep->name == '/sales/junior-leader/view-report')
        {
            $jun_report = '';
            break;
        }
    }
    
    foreach($permissions as $jun_mon){
        if($jun_mon->name == '/sales/junior-leader/view-sales')
        {
            $jun_monitoring = '';
            break;
        }
    }

    foreach($permissions as $leader){
        if($leader->name == '/sales/leader/add-sales' || $leader->name == '/sales/leader/view-sales' || $leader->name == '/sales/leader/view-report')
        {
            $leader = '';
            break;
        }
    }

    foreach($permissions as $lead_add){
        if($lead_add->name == '/sales/leader/add-sales')
        {
            $lead_add_sales = '';
            break;
        }
    }

    foreach($permissions as $lead_rep){
        if($lead_rep->name == '/sales/leader/view-report')
        {
            $lead_report = '';
            break;
        }
    }
    
    foreach($permissions as $lead_mon){
        if($lead_mon->name == '/sales/leader/view-sales')
        {
            $lead_monitoring = '';
            break;
        }
    }
    
    foreach($permissions as $man){
        if($man->name == '/sales/manager/add-sales' || $man->name == '/sales/manager/view-sales' || $man->name == '/sales/manager/view-report')
        {
            $manager = '';
            break;
        }
    }

    foreach($permissions as $man_add){
        if($man_add->name == '/sales/manager/add-sales')
        {
            $man_add_sales = '';
            break;
        }
    }

    foreach($permissions as $man_rep){
        if($man_rep->name == '/sales/manager/view-report')
        {
            $man_report = '';
            break;
        }
    }
    
    foreach($permissions as $man_mon){
        if($man_mon->name == '/sales/manager/view-sales')
        {
            $man_monitoring = '';
            break;
        }
    }
    foreach($permissions as $csr){
        if($csr->name == '/sales/csr/verify-sales' || $csr->name == '/sales/csr/add-sales' || $csr->name == '/sales/csr/view-sales' || $csr->name == '/sales/csr/view-report')
        {
            $scsr = '';
            break;
        }
    }
    
    foreach($permissions as $csr_verify){
        if($csr_verify->name == '/sales/csr/verify-sales')
        {
            $csr_verify_sales = '';
            break;
        }
    }

    foreach($permissions as $csr_add){
        if($csr_add->name == '/sales/csr/add-sales')
        {
            $csr_add_sales = '';
            break;
        }
    }

    foreach($permissions as $csr_rep){
        if($csr_rep->name == '/sales/csr/view-report')
        {
            $csr_report = '';
            break;
        }
    }
    
    foreach($permissions as $csr_mon){
        if($csr_mon->name == '/sales/csr/view-sales')
        {
            $csr_monitoring = '';
            break;
        }
    }
    foreach($permissions as $enc){
        if($enc->name == '/sales/encoder/logistics' || $enc->name == '/sales/encoder/view-sales' || $enc->name == '/sales/encoder/view-report')
        {
            $logistics = '';
            break;
        }
    }
    
    foreach($permissions as $enc_verify){
        if($enc_verify->name == '/sales/encoder/verify-sales')
        {
            $enc_verify_sales = '';
            break;
        }
    }

    foreach($permissions as $csr_add){
        if($enc_add->name == '/sales/encoder/add-sales')
        {
            $enc_add_sales = '';
            break;
        }
    }

    foreach($permissions as $csr_rep){
        if($enc_rep->name == '/sales/encoder/view-report')
        {
            $enc_report = '';
            break;
        }
    }
    
    foreach($permissions as $csr_mon){
        if($csr_mon->name == '/sales/encoder/view-sales')
        {
            $enc_monitoring = '';
            break;
        }
    }*/
?>