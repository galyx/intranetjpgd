<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOSServices extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $archive_name;
    public function __construct($archive_name)
    {
        $this->archive_name = $archive_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.sendOSServices')->subject('Copia dos valores das OSs Geradas')->from('naoresponder@jpgdescapachante.com.br', 'JPG Despachante')->attach(public_path('storage/pdfs_mail/'.$this->archive_name));

    }
}
