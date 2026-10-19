<?php

namespace Tests\Feature;

use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Http\Request;
use Tests\TestCase;

class CsrfProtectionTest extends TestCase
{
    public function test_post_without_csrf_token_is_rejected(): void
    {
        $middleware = new class ($this->app, $this->app->make(Encrypter::class)) extends ValidateCsrfToken {
            protected function runningUnitTests()
            {
                return false;
            }
        };

        $request = Request::create(
            '/csrf-test',
            'POST',
            ['example' => 'test']
        );

        $request->setLaravelSession(
            $this->app['session']->driver()
        );

        $request->headers->set('Accept', 'application/json');

        $this->expectException(
            \Illuminate\Session\TokenMismatchException::class
        );

        $middleware->handle(
            $request,
            fn() => response('Request passed middleware', 200)
        );
    }
}
