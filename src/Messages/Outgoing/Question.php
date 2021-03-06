<?php

namespace Mpociot\BotMan\Messages\Outgoing;

use JsonSerializable;
use Mpociot\BotMan\Messages\Outgoing\Actions\Button;
use Mpociot\BotMan\Interfaces\QuestionActionInterface;

class Question implements JsonSerializable
{
    /** @var array */
    protected $actions;

    /** @var string */
    protected $text;

    /** @var string */
    protected $callback_id;

    /** @var string */
    protected $fallback;

    /**
     * @param string $text
     *
     * @return static
     */
    public static function create($text)
    {
        return new static($text);
    }

    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Set the question fallback value.
     *
     * @param string $fallback
     * @return $this
     */
    public function fallback($fallback)
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * Set the callback id.
     *
     * @param string $callback_id
     * @return $this
     */
    public function callbackId($callback_id)
    {
        $this->callback_id = $callback_id;

        return $this;
    }

    public function addAction(QuestionActionInterface $action)
    {
        $this->actions[] = $action->toArray();

        return $this;
    }

    /**
     * @param \Mpociot\BotMan\Messages\Outgoing\Actions\Button $button
     * @return $this
     */
    public function addButton(Button $button)
    {
        $this->actions[] = $button->toArray();

        return $this;
    }

    /**
     * @param array $buttons
     * @return $this
     */
    public function addButtons(array $buttons)
    {
        foreach ($buttons as $button) {
            $this->actions[] = $button->toArray();
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'text' => $this->text,
            'fallback' => $this->fallback,
            'callback_id' => $this->callback_id,
            'actions' => $this->actions,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function getButtons()
    {
        return $this->actions;
    }

    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }
}
