<?php

function decrypt_file($fname) {
    $fp = file_parser($fname);
    foreach ($fp as $key => $val) {
        if ($rawval = should_decrypt($val)) {
            $val = decrypt_val(trim($rawval)) . ' # encrypt me';
        }
        if ($key) echo $key.'=';
        echo $val . PHP_EOL;
    }
}
function encrypt_file($fname) {
    $fp = file_parser($fname);
    foreach ($fp as $key => $val) {
        if ($rawval = should_encrypt($val)) {
            $val = encrypt_val($rawval) . ' # decrypt me';
        }
        if ($key) echo $key . '=';
        echo $val . PHP_EOL;
    }
}


function file_parser($input) {
    $f = fopen($input, 'r');
    while($f && !feof($f)) {
        $line = fgets($f, 4096);
        $matches=[];
        if(preg_match('/(.+?)=(.+)$/', $line, $matches)) {
            yield $matches[1] => $matches[2];
        } else {
            yield NULL => rtrim($line);
        }
    }
    fclose($f);
    return true;
}

function should_decrypt($v) {
    if (trim($v) == '') {
        return false;
    }
    $v = trim($v);

    $matches = [];
    preg_match('/(.+?)\ #.?decrypt\ me$/', $v, $matches);
    return $matches[1];
}


function should_encrypt($v) {
    if (trim($v) == '') {
        return false;
    }
    $matches = [];
    preg_match('/(.+?)\ #.?encrypt\ me$/', $v, $matches);
    return $matches[1];
}

function encrypt_val($plaintext) {
    $key = get_key();
    $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $iv             = openssl_random_pseudo_bytes($ivlen);
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $hmac           = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    return base64_encode( $iv.$hmac.$ciphertext_raw );
}

function decrypt_val($ciphertext) {
    $key = get_key();
    $c = base64_decode($ciphertext);

    $ivlen          = openssl_cipher_iv_length($cipher="AES-128-CBC");
    $sha2len        = 32;
    $iv             = substr($c, 0, $ivlen);
    $hmac           = substr($c, $ivlen, $sha2len);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $plaintext      = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
    $calcmac        = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
    if (hash_equals($hmac, $calcmac)) {
        return $plaintext;
    }
    return false;
}


function get_key() {
    return getenv('KEY');
}

if ($argc > 0) {
    if(!empty($argv[1]) && empty($argv[2])) {
        echo "usage: KEY=123 php ./dot-vault.php encrypt file\n";
        echo "       KEY=123 php ./dot-vault.php decrypt file\n";
        exit(1);
    }
    if(!empty($argv[1]) && $argv[1] == 'decrypt') {
        decrypt_file($argv[2]);
    }

    if(!empty($argv[1]) && $argv[1] == 'encrypt') {
        encrypt_file($argv[2]);
    }
}
