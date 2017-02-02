<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $username;

    /**
     * Hack to prevent people from registering
     *
     * @param string $username
     *
     * @return $this
     *
     * @throws \Exception
     */
    public function setUsername($username)
    {
        if (substr( $username, 0, 5 ) !== "dfwtr") {
            throw new \Exception("invalid username: " . $username);
        }

        $this->username = $username;

        return $this;
    }



}