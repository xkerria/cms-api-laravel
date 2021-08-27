<?php


namespace App\Model\Ability;


use Illuminate\Support\Facades\Hash;

trait Authable {
    public function auth(?string $password) {
        if (!Hash::check($password, $this->password)) throw new IncorrectPasswordException();

        $this->tokens()->delete();
        $token = $this->createToken('erp-api-token')->plainTextToken;
        return ['access_token' => $token];
    }
}
