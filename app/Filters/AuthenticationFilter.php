<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class AuthenticationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('uri');
        if (!session()->get("isAuthenticated")) {
            return redirect()->to(base_url());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
