<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sendmail extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
    }

    public function mail()
    {
        $mailSubject = "İletişim formundan mesaj var ".date('d-m-Y h:m:s');
        $sender = $this->input->post('ad');
        $senderMail = $this->input->post('email');
        $phone = $this->input->post('telefon');
        $message = $this->input->post('mesaj');

        $mailAddress = "aslblbn@gmail.com";

        $mesg = "<strong>Adı:</strong> {$sender} <br /> <strong>Mail Adresi:</strong> {$senderMail} <br /> <strong>Telefonu:</strong> {$phone} <br /> <strong>Mesajı:</strong> {$message}";

        $this->load->library('email');

        $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
        );

        $this->email->initialize($config);

        $domain = preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", $this->config->slash_item('base_url'));

        $this->email->from('no-reply@'.$domain, $domain. ' robot');
        $this->email->to($mailAddress);
        $this->email->subject($mailSubject);
        $this->email->message($mesg);


        $send = $this->email->send();
        if ($send == true) {
            $this->session->set_flashdata('message', 'Mail başarıyla gönderildi.');
            redirect(base_url());
        } else {
            echo $this->email->print_debugger();
        }

    }


}

/* End of file sendmail.php */
/* Location: ./application/controllers/sendmail.php */