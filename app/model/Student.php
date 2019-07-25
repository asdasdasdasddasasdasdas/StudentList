<?php

namespace StudentList\model;

class Student
{

    const GENDER_FEMALE = 'f';
    const GENDER_MALE = 'm';

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $hash;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $surname;

    /**
     * @var
     */
    private $group_name;
    /**
     * @var
     */
    private $gender;
    /**
     * @var
     */
    private $balli;
    /**
     * @var
     */
    private $email;

    /**
     * @param $post
     */
    public function fill($post): void
    {
        $this->setName($post['name'] ?? '');
        $this->setSurname($post['surname'] ?? '');
        $this->setBalli($post['balli'] ?? '');
        $this->setGroupName($post['group_name'] ?? '');
        $this->setEmail($post['email'] ?? '');
        $this->setGender($post['gender'] ?? '');

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->group_name;
    }

    /**
     * @param mixed $group_name
     */
    public function setGroupName($group_name)
    {
        $this->group_name = $group_name;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getBalli()
    {
        return $this->balli;
    }

    /**
     * @param mixed $balli
     */
    public function setBalli($balli)
    {
        $this->balli = $balli;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @throws \Exception
     */
    public function generateHash(): void
    {
        $this->hash = bin2hex(random_bytes(32));
    }
}
