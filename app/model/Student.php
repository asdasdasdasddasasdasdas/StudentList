<?php

namespace StudentList\model;

class Student
{
    public $id;
    public $hash;
    public $name;
    public $surname;
    public $group_name;
    public $gender;
    public $balli;
    public $email;

    const GENDER_FEMALE = 'f';
    const GENDER_MALE = 'm';


    public function fill($post): void
    {
        $this->name = $post['name'];
        $this->surname = $post['surname'];
        $this->balli = $post['balli'];
        $this->group_name = $post['group_name'];
        $this->email = $post['email'];
        $this->gender = $post['gender'];
    }


    public function generateHash(): void
    {
        $this->hash = bin2hex(random_bytes(32));
    }
}
