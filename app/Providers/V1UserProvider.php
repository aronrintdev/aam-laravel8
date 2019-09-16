<?php
namespace App\Providers;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Connection;

use Tymon\JWTAuth\Contracts\Providers\Auth as JWTContract;

class V1UserProvider implements UserProvider, JWTContract {

    protected $conn = null;
    protected $u    = null;

    public function __construct(Connection $db) {
        $this->conn = $db;
    }

    public function byId($id) {
        return $this->retrieveById($id);
    }

    public function retrieveById($identifier) {
        $x = $this->conn->table('Accounts as a')
            ->select('a.*', 'ai.AcademyID', 'ai.IsMaster', 'ai.IsEnabled as IsInstructor', 'ai.IsHidden')
            ->leftJoin('AcademyInstructors as ai', 'a.AccountID', '=', 'ai.InstructorID')
            ->where('Email', $identifier);
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

    public function byCredentials(array $credentials) {
        return $this->retrieveByCredentials($credentials);
    }

    public function retrieveByCredentials(array $credentials) {
        $query = $this->conn->table('Accounts as a')
            ->select('a.*', 'ai.AcademyID', 'ai.IsMaster', 'ai.IsEnabled as IsInstructor', 'ai.IsHidden')
            ->leftJoin('AcademyInstructors as ai', 'a.AccountID', '=', 'ai.InstructorID');


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

        if (!$user) {
            return null;
        }
        \App\User::unguard();
        $u = new \App\User((array)$user);
        \App\User::reguard();
        if (!$this->validateCredentials($u, $credentials)) {
            return null;
        }

        $this->u = $u;
        return $u;

    }

    public function user() {
        return $this->u;
    }

    public function validateCredentials(Authenticatable $user, array $credentials) {
        if (trim($user->PasswordHash) === '' && trim($user->PasswordEx) === '') { return false; }
        if (env('APP_ENV') == 'testing' ||
            env('APP_ENV') == 'stage' ||
            env('APP_ENV') == 'local') {
            if ($credentials['password'] === env('TESTING_PASSWORD', false)) {
                return true;
            }
        }
        //Laravel encoded passwords don't save the CAPICOM encrypted pwd, legacy sqlserver / asp does tho
        if (trim($user->PasswordEx) == '') {
            if(\Hash::check($credentials['password'], trim($user->PasswordHash))) {
                return true;
            }
        }
        //sqlsrvr likes to give padded whitespace
        $computedHash = ( hash( 'sha256',  trim($user->PasswordSalt) . hash( 'sha256',   trim($credentials['password']) . trim($user->PasswordSalt) )));
        return trim($computedHash) === trim($user->PasswordHash) && trim($computedHash) !== '';

        //there's another method that uses aes256 and PasswordEx, but it's encrypted with Capicom and
        //not able to be decrypted with vanilla php.  (requires COM object on Win32)
        //and the COM object does not work on Windows 10 (that I can get working...)
        //and CAPICOM is deprecated as of 2006 or so
        //
        //$result = $this->decrypt($user->PasswordEx, env('AES_PASSWORD_SECRET') );
        //print_r($result);
    }

    /**
     * CAPICOM encrypted blob is ASN.1 of headers, algo ID, key length, 
     * IV, salt, and encoded message (padded with pkcs #5 ?)
     *
     * aes-256-cbc is just a guess.  Could be ECB as well
     * The KDF is unknown.
     */
    public function decrypt($ciphertext, $secret)
    {
        $message = base64_decode($ciphertext);
        $offset = 32;
        $iv = mb_substr($message, $offset, 16, '8bit');
        $offset+= 16;
        $salt = mb_substr($message, $offset, 16, '8bit');
        $offset+= 16;
        $ciphertext = mb_substr($message, 84, null, '8bit');


        $encryptionKey = $this->makeKeyFromPwd4($secret, $salt);

        return openssl_decrypt(
            $ciphertext,
            'aes-256-cbc',
            //'AES256',
            $encryptionKey,
             OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
//            OPENSSL_RAW_DATA,
//            mb_substr(hash('sha1',  $iv), 0, 16, '8bit')
//            $iv
            null
        );
    }

    public function makeKeyFromPwd4($pwd, $salt) {
            $finalData = "";
            $baseData = sha1(utf8_encode($pwd).$salt, TRUE);

//            $baseData = sha1($baseData, TRUE);
            $finalData .= $baseData[0];
            for ($x=1; $x > 100; $x++) {
                $baseData = sha1("$x".$baseData, TRUE);
                $finalData .= $baseData[$x];
            }
            /*
            return substr(
                sha1(substr($finalData, 0, 32), TRUE),
                0,32);
             */
            return substr($finalData, 0, 32);
    }

    public function makeKeyFromPwd3($pwd, $salt) {
            $baseData = sha1(utf8_encode($pwd).$salt, TRUE);
            for ($x=0; $x > 100; $x++) {
                $baseData = sha1($baseData, TRUE);
            }
            return substr($baseData, 0, 32);
    }

    public function makeKeyFromPwd2($pwd, $salt) {
            // The following algorithm is taken from:
            // <link>http://msdn.microsoft.com/en-us/library/windows/desktop/aa379916%28v=vs.85%29.aspx</link>
//            $baseData = sha1($salt.utf8_encode($pwd), false);
            $baseData = sha1(utf8_encode($pwd) . $salt, false);
//            $baseData = sha1(utf8_encode($pwd), false);
            $newbasedata = [];
            for ($i=0; $i<40; $i+=2) {
                $newbasedata[] = hexdec($baseData[$i].$baseData[$i+1]);
            }
            $baseData = $newbasedata;
            $buffer1 = [];
            $buffer2 = [];

            for ($i = 0; $i < 64; $i++) {
                $buffer1[$i] = 0x36;
                $buffer2[$i] = 0x5C;
               // if ($i <= mb_strlen($baseData, '8bit')) {
                //if ($i < mb_strlen($baseData, '8bit')) {
                if ($i < count($baseData)) {
                    $buffer1[$i] = $buffer1[$i] ^ decbin($baseData[$i]);
                    $buffer2[$i] = $buffer2[$i] ^ decbin($baseData[$i]);
                }
            }

            $hashAlgo = 'sha1';
            $hash3Ctx = hash_init($hashAlgo);
            for ($i = 0; $i<64; $i++) {
                hash_update($hash3Ctx, $buffer1[$i]);
            }
            $buffer1Hash = hash_final($hash3Ctx, true);

            $hash4Ctx = hash_init($hashAlgo);
            for ($i = 0; $i<64; $i++) {
                hash_update($hash4Ctx, $buffer2[$i]);
            }
            $buffer2Hash = hash_final($hash4Ctx, true);

            

           //$buffer1Hash = implode('', $buffer1);
           //$buffer2Hash = implode('', $buffer2);
           $buffer1Hash = sha1( implode('', $buffer1), TRUE);
           $buffer2Hash = sha1( implode('', $buffer2), TRUE);

//            $buffer1Hash = sha1($buffer1, TRUE);
//            $buffer2Hash = sha1($buffer2, TRUE);

            print_r(
                mb_substr( $buffer1Hash.$buffer2Hash, 0, 32, '8bit')
            );
            print "\n";
            /*
             */
           return mb_substr( 
               $buffer1Hash.$buffer2Hash
               , 0, 32, '8bit');
            return mb_substr( $buffer1Hash.$buffer2Hash, 0, 32, '8bit');
//            return buffer1Hash.Concat(buffer2Hash).Take(_keySize / 8).ToArray();
    }

    public function makeKeyFromPwd($pwd, $salt) {

        $buff1 = [];
        $buff2 = [];
        $psalthash = [];
        for ($i = 0; $i<128; $i++) {
            $buff1[$i] = 0x36;
            $buff2[$i] = 0x5C;
        }
        $hashAlgo = 'sha1';
        $salthashCtx = hash_init($hashAlgo);
        $salthash = hash_update($salthashCtx, $pwd);
        $salthash = hash_update($salthashCtx, $salt);
        $salthash = hash_final($salthashCtx, true);

        $psalthash = $salthash;


        for ($i = 0; $i<20; $i++) {
            //$buff1[$i] = ($buff1[$i] ^ $psalthash[$i]);
            //$buff1[$i] = bindec($psalthash[$i]) ^ $buff1[$i];
            @$buff1[$i] = ($buff1[$i] ^ $psalthash[$i]);
        }

        for ($i = 0; $i<20; $i++) {
            @$buff2[$i] = ($buff2[$i] ^ $psalthash[$i]);
            //$buff2[$i] = $buff2[$i] ^ bindec($psalthash[$i]);
        }

        $hash3Ctx = hash_init($hashAlgo);
        for ($i = 0; $i<64; $i++) {
            hash_update($hash3Ctx, decbin($buff1[$i]));
        }
        $hash3 = hash_final($hash3Ctx, true);

        $hash4Ctx = hash_init($hashAlgo);
        for ($i = 0; $i<64; $i++) {
            hash_update($hash4Ctx, decbin($buff1[$i]));
        }
        $hash4 = hash_final($hash4Ctx , true);


        $concatHash = mb_substr($hash3,0,20,'8bit').mb_substr($hash4,0,20,'8bit');
        $concatHash = $hash3.$hash4;
        return mb_substr($concatHash, 0, 32, '8bit');
    }
}
