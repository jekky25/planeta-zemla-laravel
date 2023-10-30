<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

class emailer
{
  var $msg, $subject, $extra_headers;
  var $addresses, $reply_to, $from;
  var $use_smtp;

  var $tpl_msg = array();
  function __construct($use_smtp) 
  //function emailer($use_smtp)
  {
    $this->reset();
    $this->use_smtp = $use_smtp;
    $this->reply_to = $this->from = '';
  }

  // Resets all the data (address, template file, etc etc to default
  function reset()
  {
    $this->addresses = array();
    $this->vars = $this->msg = $this->extra_headers = '';
  }

  // Sets an email address to send to
  function email_address($address)
  {
    $this->addresses['to'] = trim($address);
  }

  function cc($address)
  {
    $this->addresses['cc'][] = trim($address);
  }

  function bcc($address)
  {
    $this->addresses['bcc'][] = trim($address);
  }

  function replyto($address)
  {
    $this->reply_to = trim($address);
  }

  function from($address)
  {
    $this->from = trim($address);
  }

  // set up subject for mail
  function set_subject($subject = '')
  {
    $this->subject = trim(preg_replace('#[\n\r]+#s', '', $subject));
  }

  // set up extra mail headers
  function extra_headers($headers)
  {
    $this->extra_headers .= trim($headers) . "\n";
  }

  function use_template($template_file)
  {
    global $board_config;

    $tpl_file = '../templates/email/' . $template_file . '.php';

    include ($tpl_file);

    $this->msg = $CODE_EMAIL;
    return true;
	}

  function send()
  {
    global $board_config;

    // Escape all quotes, else the eval will fail.
    $this->msg = str_replace ("'", "\'", $this->msg);
    $this->msg = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->msg);
    //$this->msg = convert_cyr_string($this->msg,"w","k");
    $to = $this->addresses['to'];

    // Build header
   // $this->extra_headers =  "\r\nContent-type: text/html; charset=windows-1251" . "\r\n" . (($this->from != '') ? "From: $this->from\r\n" : "From: " . $board_config['board_email'] . "\r\n");
    $fr_m ="Строение земли www.planeta-zemla.ru";
    //$fr_m=convert_cyr_string($fr_m,"w","k");
    $headers = "From: \"".$fr_m."\" <support@planeta-zemla.ru>\r\n";
    $headers .= "Content-type: text/html; charset=utf-8";
    $this->extra_headers = $headers;
    //$this->subject = convert_cyr_string($this->subject,"w","k");

    

    $result = mail(stripslashes($to), $this->subject, $this->msg, $this->extra_headers);

    // Did it work?
    if (!$result)
    {
      message_die(GENERAL_ERROR, 'Failed sending email :: ' . $result, '', 1);
    }
    return true;
  }
}
