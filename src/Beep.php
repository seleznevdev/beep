<?php

namespace Seleznev\Beep;

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
     * @param  array  $config
     * @return void
     */
    public function __construct(array $config)
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
        return Slack::make($this->config['slack_token'], $channel);
    }

    /**
     * Create a new HipChat instance.
     *
     * @param  mixed  $room
     * @return \Seleznev\Beep\Hipchat
     */
    public function hipchat($room)
    {
        return Hipchat::make($this->config['hipchat_token'], $room);
    }
}
