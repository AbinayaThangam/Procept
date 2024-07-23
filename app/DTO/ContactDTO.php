<?php
namespace App\DTO;

class ContactDTO
{
    public string $name;
    public string $email;
    public string $subject;
    public string $message;

    public function __construct(string $name, string $email, string $subject, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }
}
