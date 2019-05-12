<?php

namespace StudentList\model;

class Student
{

    const GENDER_FEMALE = 'f';
    const GENDER_MALE = 'm';

    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $hash;
    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $surname;
    /**
     * @var
     */
    public $group_name;
    /**
     * @var
     */
    public $gender;
    /**
     * @var
     */
    public $balli;
    /**
     * @var
     */
    public $email;

    /**
     * @param $post
     */
    public function fill($post): void
    {
        $this->name = $post['name'] ?? '';
        $this->surname = $post['surname'] ?? '';
        $this->balli = $post['balli'] ?? '';
        $this->group_name = $post['group_name'] ?? '';
        $this->email = $post['email'] ?? '';
        $this->gender = $post['gender'] ?? '';

    }


    /**
     * @throws \Exception
     */
    public function generateHash(): void
    {
        $this->hash = bin2hex(random_bytes(32));
    }
}
