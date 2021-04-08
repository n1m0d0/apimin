<?php
 
 namespace App\Mail;
  
  use Illuminate\Bus\Queueable;
  use Illuminate\Mail\Mailable;
  use Illuminate\Queue\SerializesModels;
  use Illuminate\Contracts\Queue\ShouldQueue;
   
class RegistroMail extends Mailable
{
   use Queueable, SerializesModels;
   
   public $registro;
   public $detalle;

    public function __construct($registro, $detalle)
    {
        $this->registro = $registro;
        $this->detalle = $detalle;
    }


    public function build()
    {
         return $this->from('contactanos@planificacion.gob.bo')
                 ->view('mail.registro')->withMenssage($this->registro)->withDetalle($this->detalle);
    }
}