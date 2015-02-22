<?php

namespace Application\Controller;

use Sohoa\Framework\Kit;

class Generic extends Kit
{
    public static $ok = 200;
    public static $error = 500;

    private $_message = ['status' => 200, 'error' => [], 'log' => [], 'data' => null];

    public function error($message, $data = [])
    {
        $this->status(static::$error);
        $this->_message['error'][] = vsprintf($message, $data);
    }

    public function log($message, $data = [])
    {
        if(is_array($message) === true)
            $this->_message['log'][] = $message;
        else
            $this->_message['log'][] = vsprintf($message, $data);
    }

    public function data($message)
    {
        $this->_message['data'] = $message;
    }

    public function status($status)
    {
        if (isset($this->_message['status']) === true) {
            if ($this->_message['status'] !== static::$error) {
                $this->_message['status'] = $status;

                return true;
            }
        }

        return false;
    }

    public function ok($message = 'ok', $data = [])
    {
        if ($this->status(static::$ok) === true) {
            $this->data(vsprintf($message, $data));
        }
    }

    public function nok($message = 'nok', $data = [])
    {
        if (isset($this->_message['status']) === true) {
            $this->error($message, $data);
        }
    }

    public function getApiJson()
    {
        return json_encode($this->_message);
    }
}
