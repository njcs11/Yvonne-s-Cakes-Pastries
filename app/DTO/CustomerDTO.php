<?php

namespace App\DTO;


class CustomerDTO
{
public string $firstName;
public string $lastName;
public ?string $mi;
public string $phone;
public string $email;
public string $address;
public string $username;
public string $password;


    public function __construct(array $data)
    {
        $this->firstName = $data['firstName'];
        $this->lastName  = $data['lastName'];
        $this->mi        = $data['mi'] ?? null;
        $this->phone     = $data['phone'];
        $this->email     = $data['email'];
        $this->address   = $data['address'];
        $this->username  = $data['username'];
        $this->password  = bcrypt($data['password']);
    }



    public function toArray(): array
    {
    return [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'mi' => $this->mi,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'username' => $this->username,
            'password' => $this->password,
            'isActive' => 1,
        ];
    }
}
    
