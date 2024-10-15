<?php

namespace App\Livewire\Pages;

use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{

    public $name;
    public $email;
    public $subject;
    public $message;

    public $rules = [
        "name" => "required",
        "email" => "required",
        "subject" => "required",
        "message" => "required",
    ];

    public function render()
    {
        return view('livewire.pages.contact');
    }

    public function send()
    {

        try {
            $validated = $this->validate($this->rules);

            Mail::to("info@vivlavivcloset.com")->send(new ContactMail($validated));

            if (count(Mail::failures()) > 0) {
                return $this->showAlert("Failed!", "Something went wrong, please try again later.", "error");
            }

            $this->reset();
            return $this->showAlert("Success!", "Thank you for reaching out! We’ve received your message and will get back to you shortly", "success");
        } catch (\Exception $e) {
            return $this->showAlert("Failed!", "Something went wrong, please try again later.", "error");
        }
    }


    public function showAlert($title, $text, $icon)
    {

        return $this->dispatch(
            "message",
            title: $title,
            text: $text,
            icon: $icon,
        );
    }
}
