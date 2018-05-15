<?php
/**
 * Created by PhpStorm.
 * User: sande
 * Date: 9/05/2018
 * Time: 14:26
 */

class Email_verzenden extends CI_Controller
{
        public function stuurMail($geadresseerde = 'r0657880@student.thomasmore.be', $boodschap = "dit is een test", $titel = "testmail") {
            $this->load->library('email');
            $this->email->from('personeelsfeesttm@gmail.com', 'personeelsfeest');
            $this->email->to($geadresseerde);
            $this->email->cc("Lindert_vdp@hotmail.com");
            $this->email->subject($titel);
            $this->email->message($boodschap);
            if(!$this->email->send()) {
                show_error($this->email->print_debugger());
                return false;
            } else {
                return true;
            }
        }
}