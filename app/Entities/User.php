<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use \Illuminate\Contracts\Auth\Authenticatable;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;

/**
 * User 
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User implements Authenticatable, HasRolesContract
{
    use HasRoles;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=100, nullable=true)
     */
    private $remember_token;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Area", mappedBy="users")
     */
    private $areas;

    /**
     * @var DateTime 
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var DateTime 
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var DateTime 
     *
     * @ORM\Column(name="login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @ACL\HasRoles()
     */
    protected $roles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add area.
     *
     * @param \Area $area
     *
     * @return User
     */
    public function addArea(Area $area)
    {
        $this->areas[] = $area;
        return $this;
    }

    /**
     * Remove area.
     *
     * @param \Area $area
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArea(Area $area)
    {
        return $this->areas->removeElement($area);
    }

    /**
     * Get areas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * @inheritDoc
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * @inheritDoc
     */
    public function getAuthIdentifier()
    {
        return $this->getId();
    }

    /**
     * @inheritDoc
     */
    public function getAuthPassword()
    {
        return $this->getPassword();
    }

    /**
     * @inheritDoc
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @inheritDoc
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRememberTokenName()
    {
        return "remember_token";
    }

    /**
     * Set created.
     *
     * @param \Datetime $created
     *
     * @return User
     */
    public function setCreated(\Datetime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \Datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated.
     *
     * @param \Datetime $updated
     *
     * @return User
     */
    public function setUpdated(\Datetime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \Datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param Role $role
     * @return User
     */
    public function addRole(Role $role)
    {
        $this->getRoles()->add($role);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set lastLogin.
     *
     * @param \Datetime $lastLogin
     *
     * @return User
     */
    public function setLastLogin(\Datetime $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    /**
     * Get lastLogin.
     *
     * @return \Datetime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        $this->setUpdated(new \DateTime('now'));
        if ($this->getCreated() === null) {
            $this->setCreated(new \DateTime('now'));
        }
    }
}
