<div class="chat-message <?= $chat_message_classes ?>" data-message-id="<?= $message->id ?>"
     data-message-from="<?= $message->from ?>">
    <div class="chat-contact">
        <?= Profile::getProfileAvatar($message->from, '40*40') ?>
    </div>
    <div class="chat-text">
        <p class="chat-desc">
            <small><?= User::model()->findByPk($message->from)->full_name ?></small>
            <span class="pull-right">
                <span class="label label-<?= $message->type == 1 ? 'info' : 'danger' ?>"><i
                        class="fa fa-<?= $message->type == 1 ? 'globe' : 'comment' ?>"
                        style="margin-right: 5px;"> <?= $message->type == 1 ? 'mesaj public' : (User::model()->findByPk($message->from)->full_name . ' -> ' . User::model()->findByPk($message->to)->full_name) ?></i></span>
                <span class="label label-default"><i class="fa fa-clock-o"
                                                     style="margin-right: 5px;"></i> <?= $message->date ?></span>
            </span>
        </p>
        <hr style="margin: 5px 0;"/>
        <p><?= $message->msg ?></p>
    </div>
</div>