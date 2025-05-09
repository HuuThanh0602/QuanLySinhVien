<?php
return [
    'required' => ':attribute không được để trống',
    'max' => [
        'array' => ':attribute không được có nhiều hơn :max mục.',
        'file' => ':attribute không được lớn hơn :max kilobyte.',
        'numeric' => ':attribute không được lớn hơn :max.',
        'string' => ':attribute không được lớn hơn :max ký tự.',
    ],
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'digits' => ':attribute phải có đúng :digits chữ số.',
    'unique' => ':attribute đã tồn tại.',
    'min' => [
        'array' => ':attribute phải có ít nhất :min mục.',
        'file' => ':attribute phải có ít nhất :min kilobyte.',
        'numeric' => ':attribute phải có ít nhất :min.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],
    'attributes' => [
        'name' => 'Tên',
        'description' => 'Mô tả',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'score' => 'Điểm',
        'student_id' => 'Mã sinh viên',
        'subject_id' => 'Mã môn học',
        'full_name' => 'Họ và tên',
        'day_of_birth' => 'Ngày sinh',
        'gender' => 'Giới tính',
        'address' => 'Địa chỉ',
        'department_id' => 'Khoa',
        'phone' => 'SĐT',
        'subject_id.*' => 'Môn học',
        'score.*' => 'Điểm',

    ],
];
