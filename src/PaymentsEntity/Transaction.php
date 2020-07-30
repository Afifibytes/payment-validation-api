<?php


namespace App\PaymentsEntity;

/**
 * This is a dummy transaction class
 *
 * Class Transaction
 * @package App\PaymentsEntity
 */
class Transaction
{
    private $user;

    private $hash;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash): void
    {
        $this->hash = $hash;
    }

    public function save()
    {
        // dummy database transaction saving.
    }

}