<?php

namespace Seleznev\Beep;

use Httpful\Request;

class Slack
{
    public $token;
    public $channel;
    public $from;
    public $message;

    /**
     * Create a new Slack instance.
     *
     * @param  string  $token
     * @param  mixed  $channel
     * @return void
     */
    public function __construct($token, $channel)
    {
        $this->token = $token;
        $this->channel = $channel;
    }

    /**
     * Create a new Slack instance.
     *
     * @param  string  $token
     * @param  mixed  $channel
     * @return \Seleznev\Beep\Slack
     */
    public static function make($token, $channel)
    {
        return new static($token, $channel);
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
     * Send the Slack message.
     *
     * @return \Httpful\Response
     */
    public function send()
    {
        $payload = [
            'token' => $this->token, 'channel' => $this->channel,
            'username' => $this->from ?: 'Beep', 'text' => $this->message,
        ];

        return Request::get('https://slack.com/api/chat.postMessage?'.http_build_query($payload))->send();
    }
}
