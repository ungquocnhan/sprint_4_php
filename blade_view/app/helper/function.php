<?php
use App\Models\Group;
use App\Models\Users;

function isUppercase($value, $message, $fail)
{
    if ($value !== strtoupper($value)) {
        $fail($message);
    }
}

function getAllGroup() {
    $groupList = new Group();
    return $groupList->getAll();
}

function getUserDetail($id) {
    $userDetail = new Users();
    return $userDetail->findById($id);
}
