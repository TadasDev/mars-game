<?php

namespace Controller;

use Core\Controller;
use Helper\FormBuilder;
use Core\Request;
use Helper\Url;

class Messages extends Controller
{

    public function index()
    {
        // Recipient ID
        $requestUrl = new Request();
        $url =  $requestUrl->explodeUrl();
        $urlId = $url[7];

        //form
        $form = new FormBuilder('post', Url::make('/messages/sendmessage'));
        if ($this->isLogedIn()) {
            $form->input('subject', 'text', '', 'Subject');
            $form->input('recipientId','hidden',$urlId);
            $form->texarea('message');
            $form->input('submit', 'submit', 'Send');
            $this->data['form'] = $form->get();
            $this->render('user/messages', $this->data);
        }
    }


    public function sendMessage()
    {
        // create
        $request = new Request();
        $messages = new \Model\Messages();
        // Sender ID
        $userId = $this->userSession->getAuthUserId();
        //  POST
        $subject = $request->getPost('subject');
        $message = $request->getPost('message');
        $recipientId = $request->getPost('recipientId');
        // Set message data
        $messages->setSubject(trim($subject,' '));
        $messages->setMessage(trim($message,' '));
        $messages->setSenderId($userId);
        $messages->setRecipientId($recipientId);
        $messages->save();
        $this->message->setSuccessMessage('Message Sent');
        //redirect to
        Url::redirect(Url::make('/user/stats'));

    }


    public function inbox()
    {
        if ($this->isLogedIn()) {
            $message = new \Model\Messages();

            $userId = $this->userSession->getAuthUserId();

            $messageTable = $message->getAllMessages($userId);
            $this->data['data'] = $messageTable;
            if (empty($messageTable)) {

                $this->message->setErrorMessage('empty Inbox');
            }
            $this->render('/user/inbox', $this->data);
        }
    }

        public function received()
        {
            if ($this->isLogedIn()) {
                $message = new \Model\Messages();
                $requestUrl = new Request();

                $messageUrl = $requestUrl->explodeUrl();
                $messageId = $messageUrl[6];

                $userId = $this->userSession->getAuthUserId();
                $dataMessage = $message->loadUserMessage($userId, $messageId);

                $this->data['messages'] = $dataMessage;
                $this->render('/user/message', $this->data);

            }
        }


}
