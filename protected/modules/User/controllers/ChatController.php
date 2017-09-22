<?php

class ChatController extends Controller
{
    public function actionChatRoom()
    {

        $chatMessages = Chatmessage::model()->findAll(array(
            'condition' => "t.type = '1' OR t.from = " . Yii::app()->user->id . " OR t.to = " . Yii::app()->user->id,
            'limit' => 20,
            'order' => 'date DESC'
        ));
        $chatMessages = array_reverse($chatMessages);

        $this->render('chatRoom', array('messages' => $chatMessages));
    }

    public function actionRefreshData()
    {
        $response = array('new_messages' => '', 'online_users' => '');

        if (isset($_POST['lastId']) && is_numeric($_POST['lastId'])) {
            $last_id = $_POST['lastId'];

            $chatMessages = Chatmessage::model()->findAll(array(
                'condition' => "id > :lastId AND (t.type = '1' OR t.from = " . Yii::app()->user->id . " OR t.to = " . Yii::app()->user->id . ")",
                'params' => array(':lastId' => $last_id),
                'order' => 'date ASC'
            ));

            foreach ($chatMessages as $message) {
                $response['new_messages'] .= $this->renderPartial('chatMessage', array('message' => $message, 'chat_message_classes' => ''), 1);
            }
        }

        //get online users list
        $all_users = User::model()->findAll();
        $online_users = array();
        $offline_users = array();
        foreach ($all_users as $key_user => $user) {
            if (Yii::app()->user->id == $user->id)
                unset($all_users[$key_user]);
            elseif (User::getIsOnlineUser($user->id))
                $online_users[] = $user;
            else
                $offline_users[] = $user;
        }

        $response['online_users'] = '<h4>Online<small> (' . count($online_users) . ')</small></h4>';
        foreach ($online_users as $online_user) {
            $response['online_users'] .= '<li data-stats="online"><a href="javascript:;">' . Profile::getProfileAvatar($online_user->id, '30*30') . '<span>' . User::model()->findByPk($online_user->id)->full_name . '</span></a></li>';
        }
        $response['online_users'] .= '<hr>';
        $response['online_users'] .= '<h4>Offline<small> (' . count($offline_users) . ')</small></h4>';
        foreach ($offline_users as $offline_user) {
            $response['online_users'] .= '<li data-stats="offline"><a href="javascript:;">' . Profile::getProfileAvatar($offline_user->id, '30*30') . '<span>' . User::model()->findByPk($offline_user->id)->full_name . '</span></a></li>';
        }
        die(json_encode($response));
    }

    public function actionWriteMessage()
    {
        if (!isset($_POST['msg'], $_POST['type'], $_POST['to']))
            die(json_encode(['state' => false, 'msg' => 'Datele nu au putut fi primite!']));
        $msg = htmlentities(trim($_POST['msg']));
        if ($msg == '')
            die(json_encode(['state' => false, 'msg' => 'Textul mesajului nu poate fi gol!']));

        $type = $_POST['type'];
        $to = $_POST['to'];
        if ($type == '2' && !is_numeric($to))
            die(json_encode(['state' => false, 'msg' => 'Nu a putut fi primit destinatarul mesajului!']));

        $message = new Chatmessage;
        $message->msg = $msg;
        $message->date = date('Y-m-d H:i:s');
        $message->from = Yii::app()->user->id;
        $message->type = $type;
        $message->to = ($type == '2' && is_numeric($to)) ? $to : null;
        $message->readed = ($type == '2' && is_numeric($to)) ? 0 : null;
        $message->create_user_id = Yii::app()->user->id;
        $message->create_datetime = date('Y-m-d H:i:s');

        if ($message->save())
            die(json_encode(['state' => true]));

        die(json_encode(['state' => false, 'msg' => 'Mesajul nu a putut fi salvat in baza de date']));
    }
}