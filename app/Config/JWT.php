<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class JWT extends BaseConfig
{
    public string $key = '8f2195861199347895f87b640866089d713c75f154569a6568853f2c5e5576a1';
    public string $algo = 'HS256';
    public int $expire = 3600;
}

// // JWT Work-flow
// Login → get token
// Token → sent in header
// Middleware → checks token
// Controller → runs only if token is valid
