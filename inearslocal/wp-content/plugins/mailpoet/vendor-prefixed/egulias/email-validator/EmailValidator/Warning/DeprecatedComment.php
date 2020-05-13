<?php

namespace MailPoetVendor\Egulias\EmailValidator\Warning;

if (!defined('ABSPATH')) exit;


class DeprecatedComment extends \MailPoetVendor\Egulias\EmailValidator\Warning\Warning
{
    const CODE = 37;
    public function __construct()
    {
        $this->message = 'Deprecated comments';
    }
}
