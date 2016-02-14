<?php

namespace Seleznev\Beep;

use Illuminate\Contracts\Config\Repository;

class Beep
{
    /**
     * Configuration options.
     *
     * @var array
     */
    protected $config;

    /**
     * Create a new Beep instance.
     *
     * @param  \Illuminate\Contracts\Config\Repository $config
     * @return void
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Create a new Slack instance.
     *
     * @param  mixed  $channel
     * @return \Seleznev\Beep\Slack
     */
    public function slack($channel = '#general')
    {
        $token = array_get($this->config, 'beep.slack_token');

        return Slack::make($token, $channel);
    }

    /**
     * Create a new HipChat instance.
     *
     * @param  mixed  $room
     * @return \Seleznev\Beep\Hipchat
     */
    public function hipchat($room)
    {
        $token = array_get($this->config, 'beep.hipchat_token');

        return Hipchat::make($token, $room);
    }
}
