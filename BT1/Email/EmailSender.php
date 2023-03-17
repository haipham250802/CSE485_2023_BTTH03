<?php
class EmailSender
{
                   private $emailServer;
                   public function __construct(EmailServerInterface $emailServer)
                   {
                                      $this->emailServer = $emailServer;
                   }
                   public function sendEmail($to, $subject, $body)
                   {
                                      $this->emailServer->sendEmail($to, $subject, $body);
                   }
}
