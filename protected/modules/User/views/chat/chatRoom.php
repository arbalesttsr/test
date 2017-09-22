<?php $this->breadcrumbs = array(
    Yii::t('mess','Chat Room')
); ?>

    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4><?= Yii::t('mess','Chat Room') ?></h4>
                        <div class="options">
                            <a href="javascript:;"><i class="fa fa-cog"></i></a>
                            <a href="javascript:refreshChatData();"><i class="fa fa-refresh"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel-chat well" id="chat">
                                    <?php $arr_chat_colors = [
                                        'primary',
                                        //'warning',
                                        'indigo',
                                        'midnightblue',
                                        'success',
                                        'inverse',
                                        'brown',
                                        'indigo',
                                        'orange',
                                        'sky',
                                        'magenta',
                                        'green',
                                        'purple'
                                    ]; ?>
                                    <?php $user_colors[Yii::app()->user->id] = 'default'; ?>
                                    <?php $all_users = User::model()->findAll(); ?>
                                    <?php $user_colors = []; ?>
                                    <?php foreach ($all_users as $user) {
                                        if ($user->id == Yii::app()->user->id) {
                                            $user_colors[$user->id] = 'default';
                                        } elseif (Yii::app()->user->isSa()) {
                                            $user_colors[$user->id] = 'warning';
                                        } else {
                                            $user_colors[$user->id] = $arr_chat_colors[(int)($user->id % count($arr_chat_colors))];
                                        }
                                    } ?>
                                    <div class="chat-message" data-message-id="0"></div>
                                    <?php if (count($messages)) { ?>
                                        <?php foreach ($messages as $message) { ?>
                                            <?php $chat_message_classes = ($message->from == Yii::app()->user->id) ? 'me' : 'chat-' . $user_colors[$message->from]; ?>
                                            <?php $this->renderPartial('chatMessage', array('message' => $message, 'chat_message_classes' => $chat_message_classes)); ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <div class="alert alert-dismissable alert-warning no_messages">
                                            <?= Yii::t('mess','allert no msg') ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <form action="#" id="writeMessageForm">
                                    <div class="input-group">
                                        <input type="text" placeholder= "<?= Yii::t('mess','put msg') ?>"
                                               class="form-control message-msg">
                                        <input type="hidden" class="message-to" value="">
                                    <span class="input-group-addon">
                                        <label for="message-type" style="margin: 0 5px 0; position: relative;">
                                            <small style="padding-right: 20px;"><?= Yii::t('mess','priv msg') ?></small>
                                            <input type="checkbox" class="message-type" name="message-type"
                                                   style="position: absolute; bottom: 0; right: 0;">
                                            <div id='list-users-private' class="panel panel-success"
                                                 style="position: absolute; min-width: 300px; bottom: 25px; right: -10px; margin-bottom: 0; display:none;">
                                                <div class="panel-heading show-list-users-private">
                                                    <h4><?= Yii::t('mess','choose user') ?></h4>
                                                    <div class="options">
                                                        <a href="javascript:;" class="panel-collapse"
                                                           data-toggle="collapse" data-target="#list-users-private"><i
                                                                class="fa fa-chevron-up"></i></a>
                                                    </div>
                                                </div>
                                                <div class="panel-body" style="display: none;">
                                                    <!--div class="btn-group-vertical pull-right col-md-12">
                                                        <?php ?>
                                                        <?php foreach ($all_users as $user) { ?>
                                                            <?php if ($user->id != Yii::app()->user->id) { ?>
                                                                <button type="button" class="btn btn-primary-alt btn-label private-user" style="text-align: left; height: 30px;" data-user-id="<?= $user->id ?>">
                                                                    <i style="padding: 5px 10px;"><?= Profile::getProfileAvatar($user->id, '20*20') ?></i>
                                                                    <small style="margin: 0 5px;"><?= $user->full_name ?></small>
                                                                </button>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </div-->
                                                    <div class="list-group">
                                                        <?php foreach ($all_users as $user) { ?>
                                                            <?php if ($user->id != Yii::app()->user->id) { ?>
                                                                <span class="list-group-item private-user"
                                                                      data-user-id="<?= $user->id ?>"
                                                                      style="padding: 8px 15px;">
                                                                    <small
                                                                        style="margin: 0 5px; float: left;"><?= $user->full_name ?></small>
                                                                    <span
                                                                        style="float: right;"><?= Profile::getProfileAvatar($user->id, '12*12') ?></span>
                                                                    <div style="clear:both"></div>
                                                                </span>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <!--a href="#" class="list-group-item"><span class="badge">201</span> <i class="fa fa-envelope"></i> Inbox </a>
                                                        <a href="#" class="list-group-item active"><span class="badge">5021</span> <i class="fa fa-eye"></i> Profile visits </a>
                                                        <a href="#" class="list-group-item"><span class="badge">14</span> <i class="fa fa-phone"></i> Call </a>
                                                        <a href="#" class="list-group-item"><span class="badge">20</span> <i class="fa fa-comments"></i> Messages </a>
                                                        <a href="#" class="list-group-item"><span class="badge">14</span> <i class="fa fa-bookmark"></i> Bookmarks </a>
                                                        <a href="#" class="list-group-item"><span class="badge">30</span> <i class="fa fa-bell"></i> Notifications </a-->
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </span>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary addMessage"><i
                                                class="fa fa-comments-o"></i></button>
                                    </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-body">
                                        <ul class="chat-users"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php Yii::app()->clientScript->registerScript('chat-room-scripts', '
$(document).on("click", "#writeMessageForm .addMessage", function(){ writeMessage($("#writeMessageForm .message-msg").val()); });

$(document).on("keypress", "#writeMessageForm .message-msg", function(e) {
//$("form#writeMessageForm").submit(function(e) {
    if(e.which == 13) {
        e.preventDefault();
        var message = $("#writeMessageForm .message-msg").val();
        $("#writeMessageForm .message-msg").val("");
        writeMessage(message);
    }
});

$(document).on("change", "#writeMessageForm .message-type", function(){
    if($(this).is(":checked"))
        $("#list-users-private").fadeIn();
    else{
        $("#list-users-private").fadeOut();
        $("#writeMessageForm .message-to").val("");
    }
});

$(document).on("click", "span.private-user", function(){
    $("span.private-user").removeClass("active");
    $(this).addClass("active");
    var user_id = $(this).data("user-id");
    $("#writeMessageForm .message-to").val(user_id);
});

function writeMessage(message){
    $.ajax({
        url:"' . $this->createUrl('writeMessage') . '",
        data: {
            msg: message,
            type: $("#writeMessageForm .message-type").is(":checked") ? 2 : 1,
            to: $("#writeMessageForm .message-to").val(),
        },
        type: "POST",
        dataType: "JSON",
        success: function(result){
            switch(true){
                case (typeof(result.state) == undefined):
                    msg_notify("bottomLeft", "error", 3000, "Datele nu au fost primite");
                    break;
                case (!result.state):
                    msg_notify("bottomLeft", "error", 3000, result.msg);
                    $("#writeMessageForm .message-msg").val("");
                    //$("#writeMessageForm .message-type").prop("checked", false).change();
                    $("#list-users-private .panel-body").hide();
                    break;
                default:
                    $("#writeMessageForm .message-msg").val("");
                    //$("#writeMessageForm .message-type").prop("checked", false).change();
                    $("#list-users-private .panel-body").hide();
                    refreshChatData();
                    break;
            }
        }
    });

}

function refreshChatData(){
    var lastChatMessageId = $(".panel-chat .chat-message").last().data("message-id");

    $.ajax({
        url:"' . $this->createUrl('refreshData') . '",
        data: {
            lastId: lastChatMessageId,
            type: 1
        },
        type: "POST",
        dataType: "JSON",
        success:function(result){
            if(typeof(result.new_messages) != undefined && result.new_messages != ""){
                if($(".no_messages").length)
                    $(".no_messages").remove();

                var new_messages = $(result.new_messages);
                $(".panel-chat").append(new_messages);
                new_messages.each(function(){
                    resolveMessagesColors($(this).data("message-id"), $(this).data("message-from"))
                })
                $(".panel-chat").animate({ scrollTop: $(".panel-chat")[0].scrollHeight}, 1000);
            }
            if(typeof(result.online_users) != undefined && result.online_users != ""){
                $("ul.chat-users").html($(result.online_users))
            }
        }
    });

}

function resolveMessagesColors(message_id, message_from){
    var user_id = ' . Yii::app()->user->id . ';
    if(message_from == user_id)
        $("#chat .chat-message[data-message-id=\'"+message_id+"\']").addClass("me");

    var users_colors = ' . json_encode($user_colors) . ';
    for (var user_color in users_colors) {
        if (users_colors.hasOwnProperty(user_color) && user_color == message_from) {
            var style = users_colors[user_color];
            $("#chat .chat-message[data-message-id=\'"+message_id+"\']").addClass("chat-"+style);
            $("#chat .chat-message[data-message-id=\'"+message_id+"\']").find(".chat-desc span.label").addClass("label-"+style);
        }
    }
    //console.log(usersColors)
}

', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('refresh-data-chat', '
    $(".panel-chat").animate({ scrollTop: $(".panel-chat")[0].scrollHeight}, 1000);
    setInterval(refreshChatData, 5000);
    //disable loading indicator for chat page
    $("#loading-indicator").css({"opacity":"0"});

    refreshChatData();
', CClientScript::POS_READY);


Yii::app()->clientScript->registerCss('css-data-chat', '
    .chat-message.me .chat-desc{ float: _right}
    .show-list-users-private{cursor: pointer;}
    span.private-user{cursor: pointer;}
    span.private-user.active{background-color: #454545; border: 2px solid #333333;}
    span.private-user.active:hover{background-color: #565656;}
');