<?php

class Hash
{
    public static function getHash($algoritmus, $data, $key)
    {
        $hash = hash_init($algoritmus, HASH_HMAC, $key);
        hash_update($hash, $data);

        return hash_final($hash);
    }
}