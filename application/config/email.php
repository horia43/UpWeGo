<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.mailgun.org';
$config['smtp_port'] = 465;
$config['smtp_user'] = '[your Mailgun SMTP username]';
$config['smtp_pass'] = '[your Mailgun SMTP password]';
$config['smtp_timeout'] = '4';
$config['crlf'] = '\n';
$config['newline'] = '\r\n';
 // domain    sandboxe7be032ef33f4a17b48195d687c56a1b.mailgun.org
//trebuie sa descarc libraria de mail gun sa o includ in proiect
//  api key        key-389d3c824bd69e33ec4223fdf0fff9dc
