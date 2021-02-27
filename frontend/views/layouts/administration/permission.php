<?php
    $dashboard = 'hidden';
    $employee = 'hidden';
    $master = 'hidden';
    $attendance = 'hidden';
    $payroll = 'hidden';
    $status = 'hidden';
    $employment = 'hidden';
    $employment_designation = 'hidden';
    $employment_status = 'hidden';

    $permissions = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id);
    foreach($permissions as $dash){
        if($dash->name == '/administration/dashboard/*')
        {
            $dashboard = '';
            break;
        }
    }
    foreach($permissions as $emp){
        if($emp->name == '/administration/employee/master-list' || $emp->name == '/administration/employee/attendance' || $emp->name == '/administration/employee/payroll' || $emp->name == '/administration/employee/status')
        {
            $employee = '';
            break;
        }
    }

    foreach($permissions as $list){
        if($list->name == '/administration/employee/master-list')
        {
            $master = '';
            break;
        }
    }

    foreach($permissions as $attnd){
        if($attnd->name == '/administration/employee/attendance')
        {
            $attendance = '';
            break;
        }
    }
    
    foreach($permissions as $pyrl){
        if($pyrl->name == '/administration/employee/payroll')
        {
            $payroll = '';
            break;
        }
    }
    
    foreach($permissions as $stat){
        if($stat->name == '/administration/employee/status')
        {
            $status = '';
            break;
        }
    }

    foreach($permissions as $emplmnt){
        if($emplmnt->name == '/administration/employment-designation/*' || $emplmnt->name == '/administration/employment-status/*')
        {
            $employment = '';
            break;
        }
    }
    foreach($permissions as $des){
        if($des->name == '/administration/employment-designation/*')
        {
            $employment_designation = '';
            break;
        }
    }

    foreach($permissions as $sta){
        if($sta->name == '/administration/employment-status/*')
        {
            $employment_status = '';
            break;
        }
    }
?>