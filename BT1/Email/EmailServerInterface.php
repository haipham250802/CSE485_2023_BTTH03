<?php
interface EmailServerInterface
{
    public function sendEmail($to, $subject, $body);
}
?>