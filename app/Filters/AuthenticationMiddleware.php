<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\JWT as JWTConfig;

class AuthenticationMiddleware implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Get Authorization header
        $authHeader = $request->getHeaderLine('Authorization');

        // 2. If header missing
        if (!$authHeader) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Token not provided'
                ]);
        }

        // 3. Extract token
        $token = str_replace('Bearer ', '', $authHeader);

        try {
            // 4. Verify token
            $config = new JWTConfig();

            $decoded = JWT::decode(
                $token,
                new Key($config->key, $config->algo)
            );

            // 5. Attach user data (optional)
            $request->user = $decoded;

        } catch (\Exception $e) {
            // 6. Invalid or expired token
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Token is invalid or expired'
                ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}
