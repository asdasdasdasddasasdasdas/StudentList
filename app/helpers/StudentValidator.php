<?php

namespace StudentList\helpers;

use StudentList\model\Student;
use StudentList\model\StudentTableGateway;

class StudentValidator
{

    /**
     * @var
     */
    private $studentTG;

    /**
     * StudentValidator constructor.
     * @param StudentTableGateway $db
     */
    public function __construct(StudentTableGateway $studentTG)
    {
        $this->studentTG = $studentTG;
    }


    /**
     * @param $student
     * @return array
     */
    public function validateAll($student, $token): array // Проверяет все входящие данные из формы.
    {
        $errors = [];
        $errors['name_error'] = $this->validateName($student->name);
        $errors['surname_error'] = $this->validateSurname($student->surname);
        $errors['group_name_error'] = $this->validateGroup($student->group_name);
        $errors['gender_error'] = $this->validateGender($student->gender);
        $errors['balli_error'] = $this->validateBalli($student->balli);
        $errors['email_error'] = $this->validateEmail($student->email, $student->id);
        $errors['token_error'] = $token;
        return array_filter($errors, function ($value) {
            return $value !== null;
        });
    }

    /**
     * @param $name
     * @return string|null
     */
    public function validateName($name)
    {
        $length = mb_strlen($name);
        if ($length > 40) {
            return "Длина Имени не должна превышать 40 символов, а вы ввели {$length}";
        } elseif ($length == 0) {
            return "Вы не ввели имя";
        }
        return null;
    }

    /**
     * @param $surname
     * @return string|null
     */
    private function validateSurname($surname)
    {
        $length = mb_strlen($surname);
        if ($length > 40) {
            return "Длина фамилии не должна превышать 40 символов, а вы ввели {$length}";
        } elseif ($length == 0) {
            return "Вы не ввели Фамилию";
        }
        return null;
    }

    /**
     * @param $group
     * @return string|null
     */
    private function validateGroup($group)
    {

        $length = mb_strlen($group);
        if ($length == 0) {
            return "Вы не ввели группу";
        } elseif ($length < 2 || $length > 5) {
            return "Вы ввели недопустимое количество символов. Должно быть в пределе от 2 до 5, а вы ввели {$length}";
        } elseif (!preg_match("/^[а-яёА-ЯЁ0-9]+$/u", $group)) {
            return "Номер группы может содержать только русские буквы и цифры";
        }
        return null;

    }

    /**
     * @param $gender
     * @return string|null
     */
    private function validateGender($gender)
    {

        if ($gender !== Student::GENDER_FEMALE && $gender !== Student::GENDER_MALE) {
            return "Вы не ввели свой пол";
        }
        return null;
    }

    /**
     * @param $balli
     * @return string|null
     */
    private function validateBalli($balli)
    {
        if ($balli > 300 || $balli < 50) {
            return "Количество баллов должно находится в пределе от 50 до 300, а вы ввели $balli";
        }
        if ($balli === 0) {
            return "вы не ввели количество баллов";
        }
        return null;
    }

    /**
     * @param $email
     * @param $id
     * @return string|null
     */
    private function validateEmail($email, $id)
    {
        $length = mb_strlen($email);
        if ($length == 0) {
            return "Вы не ввели почту";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "E-mail должен быть в формате \"asdasd@domain.com\".";
        } elseif ($this->studentTG->CheckEmail($email, $id)) {

            return "Такой E-mail уже сущестует";
        }
        return null;
    }

}
