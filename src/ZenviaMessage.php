<?php

namespace NotificationChannels\Zenvia;

use Illuminate\Support\Arr;

class ZenviaMessage
{
    public $from;
    public $to;
    public $msg;
    public $id;

    public static function create($msg = null)
    {
        return new static($msg);
    }

    public function __construct($msg = null)
    {
        $this->msg($msg);
    }

    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    public function msg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    public function content($content)
    {
        $this->msg($content);
        return $this;
    }

    public function id($id)
    {
        $this->id = $id;
        return $this;
    }

    public function toArray()
    {
        return [
            'from' => $this->from,
            'to'   => $this->to,
            'msg'  => $this->msg,
            'id'   => $this->id,
        ];
    }
}
