<?php

namespace DataHub\UserBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/** 
 * DTO for Profile
 */
class ProfileEditData
{
    /**
     * @var string $username
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $username;

    /**
     * @var string $firstName
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $lastName;

    /**
     * @var string $password
     * 
     * @Assert\Type("String")
     */
    private $password;

    /**
     * @var string $plainPassword
     * 
     * A non-persisted field used to create the encoded password.
     *
     * @Assert\NotBlank(message="Password cannot be empty", groups={"Create"})
     */
    private $plainPassword;

    /**
     * @var string $email
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var boolean $enabled
     */
    private $enabled;

    /**
     * @var array $roles
     */
    private $roles;

    /**
     * @var string $confirmationToken
     * 
     * @Assert\Type("String")
     */
    private $confirmationToken;


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        $roles = $this->roles;

        if (!is_array($roles)) {
            $roles = array('ROLE_CONSUMER');
        }

        return $roles;
    }

    public function setRoles(array $roles)
    {
        // give everyone ROLE_CONSUMER!
        if (!in_array('ROLE_CONSUMER', $roles)) {
            $roles[] = 'ROLE_CONSUMER';
        }

        $this->roles = $roles;
    }

    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;
    }    
}
