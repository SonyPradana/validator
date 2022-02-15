<?php

declare(strict_types=1);

namespace Validator\Messages;

final class MessagePool
{
    /** @var Message[] */
    private $messages = [];

    /**
     * Field tobe set.
     *
     * @param string $name field name
     *
     * @return Message
     */
    public function __get($name)
    {
        return $this->field($name);
    }

    /**
     * Field tobe set.
     *
     * @param string $name field name
     *
     * @return Message
     */
    public function field(string $name)
    {
        return $this->messages[$name] = new Message();
    }

    /**
     * @return Message[]
     */
    public function Messages()
    {
        return $this->messages;
    }
}
