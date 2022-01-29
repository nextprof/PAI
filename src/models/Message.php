<?php

namespace models;

use JsonSerializable;

class Message implements JsonSerializable
{
    private int $id;
    private int $id_from;
    private int $id_to;
    private string $message;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdFrom(): int
    {
        return $this->id_from;
    }

    /**
     * @param int $id_from
     */
    public function setIdFrom(int $id_from): void
    {
        $this->id_from = $id_from;
    }

    /**
     * @return int
     */
    public function getIdTo(): int
    {
        return $this->id_to;
    }

    /**
     * @param int $id_to
     */
    public function setIdTo(int $id_to): void
    {
        $this->id_to = $id_to;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}