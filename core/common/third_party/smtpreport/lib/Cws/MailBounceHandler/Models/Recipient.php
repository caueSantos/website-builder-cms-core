<?php

namespace Cws\MailBounceHandler\Models;

use Cws\MailBounceHandler\Handler;

/**
 * Recipient.
 *
 * @author Cr@zy
 * @copyright 2013-2016, Cr@zy
 * @license GNU LESSER GENERAL PUBLIC LICENSE
 *
 * @link https://github.com/crazy-max/CwsMailBounceHandler
 */
class Recipient
{
    /**
     * The DSN action (only for DSN process).
     *
     * @var string
     */
    public $action;

    /**
     * The status code.
     *
     * @var string
     */
    public $status;
    
    public $subject;

    /**
     * The recipient email.
     *
     * @var string
     */
    public $email;

    /**
     * Bounce type (see BOUNCE_ const in Cws\MailBounceHandler\Handler).
     *
     * @var string
     */
    public $bounceType;

    /**
     * Bounce category (see CAT_ const in Cws\MailBounceHandler\Handler).
     *
     * @var string
     */
    public $bounceCat;

    /**
     * To remove.
     *
     * @var bool
     */
    public $remove;

    public function __construct()
    {
        $this->action = null;
        $this->status = null;
        $this->subject = null;
        $this->email = null;
        $this->bounceCat = null;
        $this->bounceCat = Handler::CAT_UNRECOGNIZED;
        $this->remove = false;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    } 
    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getBounceType()
    {
        return $this->bounceType;
    }

    public function setBounceType($bounceType)
    {
        $this->bounceType = $bounceType;
    }

    public function getBounceCat()
    {
        return $this->bounceCat;
    }

    public function setBounceCat($bounceCat)
    {
        $this->bounceCat = $bounceCat;
    }

    public function isRemove()
    {
        return $this->remove;
    }

    public function setRemove($remove)
    {
        $this->remove = $remove;
    }
}
