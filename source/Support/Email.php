<?php
namespace Source\Support;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use stdClass;

class Email{
    private $email;
    private $data;

    /**
     *  INSTANCIA A CLASSE COM AS CONFIGURAÇÕES
     */
    public function __construct()
    {
        $this->email = new PHPMailer(true);
        $this->data  = new stdClass();
        $this->email->isSMTP();
        $this->email->isHTML(true);
        $this->email->SMTPAuth = true;
        $this->email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $this->email->Host     = EMAIL['host'];
        $this->email->Port     = EMAIL['port'];
        $this->email->Username = EMAIL['user'];
        $this->email->Password = EMAIL['password'];
    }

    /**
     * ADICIONA NA CLASSE DATA AS INFORMAÇÕES
     */
    public function add($recipientEmail,$recipientName,$subject,$body): Email
    {
        $this->data->recipientEmail = $recipientEmail;
        $this->data->recipientName  = $recipientName;
        $this->data->subject        = $subject;
        $this->data->body           = $body;
        return $this;
    }

    /**
     *  EXECUTA O ENVIO DE EMAIL
     */
    public function send()
    {
        $this->email->setFrom(EMAIL['user'], EMAIL['name']);
        $this->email->addAddress($this->data->recipientEmail,$this->data->recipientName);
        $this->email->Subject = $this->data->subject;
        $this->email->Body    = $this->data->body;

        try {
            $this->email->send();
            return true;
        } catch (Exception $th) {
            return false;
        }

    }
}