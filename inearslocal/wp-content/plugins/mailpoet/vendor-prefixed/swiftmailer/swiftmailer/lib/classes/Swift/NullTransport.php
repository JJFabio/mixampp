<?php

namespace MailPoetVendor;

if (!defined('ABSPATH')) exit;


/*
 * This file is part of SwiftMailer.
 * (c) 2009 Fabien Potencier <fabien.potencier@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Pretends messages have been sent, but just ignores them.
 *
 * @author Fabien Potencier
 */
class Swift_NullTransport extends \MailPoetVendor\Swift_Transport_NullTransport
{
    public function __construct()
    {
        \call_user_func_array([$this, 'MailPoetVendor\\Swift_Transport_NullTransport::__construct'], \MailPoetVendor\Swift_DependencyContainer::getInstance()->createDependenciesFor('transport.null'));
    }
}
