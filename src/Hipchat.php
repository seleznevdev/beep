<?php

namespace Seleznev\Beep;

use Httpful\Request;

class Hipchat
{
    protected $token;
    protected $room;
    protected $from;
    protected $message;

    /**
     * Create a new Hipchat instance.
     *
     * @param  string  $token
     * @param  mixed  $room
     * @return void
     */
    public function __construct($token, $room)
    {
        $this->token = $token;
        $this->room = $room;
    }

    /**
     * Create a new HipChat instance.
     *
     * @param  string  $token
     * @param  mixed  $room
     * @return \Seleznev\Beep\Hipchat
     */
    public static function make($token, $room)
    {
        return new static($token, $room);
    }

    /**
     * Set the message author.
     *
     * @param  string  $name
     * @return void
     */
    public function from($name)
    {
        $this->from = $name;

        return $this;
    }

    /**
     * Send the message.
     *
     * @param  string  $message
     * @return \Httpful\Response
     */
    public function say($message)
    {
        $this->message = $message;

        return $this->send();
    }

    /**
     * Send the HipChat message.
     *
     * @return \Httpful\Response
     */
    protected function send()
    {
        $format = $this->message != strip_tags($this->message) ? 'html' : 'text';

        $payload = [
            'auth_token' => $this->token, 'room_id' => $this->room,
            'from' => $this->from ?: 'Beep', 'message' => $this->message,
            'message_format' => $format, 'notify' => 1, 'color' => 'purple',
        ];

        return Request::get('https://api.hipchat.com/v1/rooms/message?'.http_build_query($payload))->send();
    }
}
