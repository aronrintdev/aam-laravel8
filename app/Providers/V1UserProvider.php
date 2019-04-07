<?php
namespace App\Providers;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

class V1UserProvider implements UserProvider {

    protected $conn = null;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function retrieveById($identifier) {
        $x = $this->conn->table('Accounts');
        $x->where('Email', $identifier);
        $user = $x->first();

        \App\User::unguard();
        $u = new \App\User((array)$user);
        \App\User::reguard();
        return $u;
    }

    public function retrieveByToken($identifier, $token) {
    }

    public function updateRememberToken(Authenticatable $user, $token) {
    }

    public function retrieveByCredentials(array $credentials) {
        $query = $this->conn->table('Accounts');

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } else {
                $query->where($key, $value);
            }
        }

        // Now we are ready to execute the query to see if we have an user matching
        // the given credentials. If not, we will just return nulls and indicate
        // that there are no matching users for these given credential arrays.
        $user = $query->first();

        \App\User::unguard();
        $u = new \App\User((array)$user);
        \App\User::reguard();
        return $u;

    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        //sqlsrvr lines to give padded whitespace
        return (\Hash::check($credentials['password'], trim($user->PasswordHash)));
    }
}
