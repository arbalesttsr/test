<?php
/**
 * Created by PhpStorm.
 * User: tudor
 */
$this->breadcrumbs = array(
    'User' => array("User/default/administration"),
    $this->module->id => array("{$this->module->id}/default/administration"),
    Yii::t('UserModule.t', 'LIST_AD_USERS'),
);

$nr = count($accounts);

?>

    <h1> List Users From Active Direcotry</h1>
    <hr>
    <div class="col-sm-12">
        <div class="panel panel-sky">
            <div class="panel-heading">
                <h4><i class="fa fa-cloud icon-highlight"></i>All Users From Active Directory</h4>

            </div>
            <div class="panel-body">

                <div class="table-flipscroll">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="btn-group">
                                <a onclick="actionImportChecked();" class="btn btn-primary btn-label"
                                   id="ToolTables_crudtable_0">
                                    <i class="fa fa-exchange"></i>
                                    <span>Import Selected AD-Users into Synapsis</span>
                                </a>

                                <span class="label label-success" style="font-size: 13px; margin:10px 10px;">Already Exist</span>
                                <span class="label label-warning"
                                      style="font-size: 13px; margin:10px 10px;">Not Exist</span>

                            </div>
                        </div>

                    </div>
                    <br>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatables dataTable"
                           id="example" aria-describedby="example_info">
                        <thead>
                        <tr role="row">
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th style="text-align: center;">Ldap Login</th>
                            <th style="text-align: center;">Synapsis Ldap Login</th>
                            <th style="text-align: center;">First Name</th>
                            <th style="text-align: center;">Last Name</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Role</th>
                        </tr>
                        </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                        <?php
                        $nr = count($accounts);
                        foreach ($accounts as $record) {
                            $fullname = $record['first_name'] . ' ' . $record['last_name'];
                            if (ImportUsersAD::CheckInUserAdUsername($record['login']) !== 'Not Set')
                                $bgcolor = '#85c744';
                            else
                                $bgcolor = '#f1c40f';
                            echo CHtml::tag('tr', array('class' => 'gradeA odd', 'bgcolor' => $bgcolor));
                            echo '<td style="width: 14px;"><input type="checkbox" class ="checkfiles" id="' . $record['login'] . '" data-adlogin="' . $record['login'] . '" data-adfullname="' . $fullname . '" data-ademail="' . $record['mail'] . '" data-role="' . $role . '" /></td>';
                            echo '<td>' . $record['login'] . '</td>';
                            echo '<td>' . ImportUsersAD::CheckInUserAdUsername($record['login']) . '</td>';
                            echo '<td>' . $record['first_name'] . '</td>';
                            echo '<td>' . $record['last_name'] . '</td>';
                            echo '<td>' . $record['mail'] . '</td>';
                            echo '<td>' . $role . '</td>';
                            echo CHtml::closeTag('tr');
                        }

                        ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

<?php

$cs = Yii::app()->getClientScript();
$cs->registerScript('ad_users', "


//script for checkbox , check all
$('#selectAll').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});

//functii
function actionImportChecked(){

var ad_array = [];
if($('.checkfiles:checked').length == 0)
{
    msg_notify('bottomLeft', 'error', 8000, 'Selecteaza utilizator pentru importare in sistem !!!');
}
else
{
   $('.checkfiles:checked').each(function(){
    var login = $(this).data('adlogin');
    var fullname = $(this).data('adfullname');
    var email = $(this).data('ademail');
    var role = $(this).data('role');
    var adInfo = login+'|'+fullname+'|'+email;
    ad_array.push(adInfo);
          if($('.checkfiles:checked').length == 0)
          {
            msg_notify('bottomLeft', 'waring', 8000, 'Selecteaza utilizator pentru importare in sistem !!!');
          }
          else
          {
            if($('.checkfiles:checked').length == ad_array.length)
                  {
                    console.log(ad_array,role);
                    actionCallRegisterNewUsers(ad_array,role);
                  }
          }

    });
    }
}

// apelare actiune
function actionCallRegisterNewUsers(user_info,userorle) {
var str_url = '" . Yii::app()->createUrl('/User/LoginAD/ldapSettings/registerNewUsers') . "';
$.ajax({
    url : str_url,
    type: \"POST\",
    data : { ldapdata : user_info, role : userorle},
    success: function(data)
    {
        msg_notify('bottomLeft', 'primary', 8000, 'Importat cu succes <br>'+data);
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        msg_notify('bottomLeft', 'error', 8000, textStatus);
    }
});

}


", CClientScript::POS_END);


?>