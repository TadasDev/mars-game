<?php
namespace Model;

use Core\Db;

class Messages extends ModelAbstract
{
    public const TABLE_NAME = 'messages';
    public const SUBJECT = 'subject';
    public const MESSAGES = 'message';
    public const SENDER = 'sender_id';
    public const RECIPIENT = 'recipient_id';
    public const MESSAGE_ID = 'id';

    public $message;
    public $subject;
    public $senderId;
    public $recipientId;

    /**
     * @return mixed
     */
    public function getRecipientId()
    {
        return $this->recipientId;
    }

    /**
     * @param mixed $recipientId
     */
    public function setRecipientId($recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    /**
     * @return mixed
     */
    public function getSenderId()
    {
        return $this->senderId;
    }

    /**
     * @param mixed $senderId
     */
    public function setSenderId($senderId): void
    {
        $this->senderId = $senderId;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function prepeareArray()
    {
        return [
            self::SENDER => $this->senderId,
            self::RECIPIENT => $this->recipientId,
            self::MESSAGES => $this->message,
            self::SUBJECT=>$this->subject
        ];

    }

    public function getAllMessages($id)
    {
        $db = new Db();
        $results = $user = $db->select()
            ->from(self::TABLE_NAME)
            ->where(self::RECIPIENT,$id)
            ->get();

               return $results;
    }

    public function loadUserMessage($id, $messageId)
    {

        $db = new Db();
        $results = $db->select()
            ->from(self::TABLE_NAME)
            ->where(self::RECIPIENT,$id)
            ->whereAnd(self::MESSAGE_ID, $messageId)
            ->get();

        return $results;
    }
}