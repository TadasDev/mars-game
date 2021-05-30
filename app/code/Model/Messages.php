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
    public const IS_READ = 'is_read';

    public $message;
    public $subject;
    public $senderId;
    public $recipientId;
    public $isRead;

    /**
     * @return int
     */
    public function getIsRead(): int
    {
        return $this->isRead;
    }

    /**
     * @param int $isRead
     */
    public function setIsRead(int $isRead): void
    {
        $this->isRead = $isRead;
    }

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
            self::SUBJECT=>$this->subject,
            self::IS_READ =>$this->isRead
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

    public function isRead($messageId)
    {
        $db = new Db();
        $results = $db
            ->update(self::TABLE_NAME)
            ->setOne(self::IS_READ,'1')
            ->where(self::MESSAGE_ID,$messageId)->exec();
    }

    public function newNotification($id){

        $db = new Db();
        $results = $db->select(self::IS_READ)
            ->count(1)
            ->from(self::TABLE_NAME)
            ->where(self::IS_READ,'0')->whereAnd(self::RECIPIENT,$id)
            ->groupBy(self::IS_READ)->get();

        return $results;
    }
}