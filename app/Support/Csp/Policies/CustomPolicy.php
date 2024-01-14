<?php

namespace App\Support\Csp\Policies;

use Spatie\Csp\Policies\Basic;
use Spatie\Csp\Directive;

class CustomPolicy extends Basic
{
    public function configure()
    {
        parent::configure();

        $this->addDirective(Directive::SCRIPT, [
            "'self'",
            "'unsafe-eval'",
            'https://www.google.com',
            'https://www.gstatic.com',
        ]);

        $this->addDirective(Directive::FRAME, [
            'https://www.google.com',
            'https://recaptcha.google.com'
        ]);

        $this->addDirective(Directive::STYLE, [
            "'self'",
            "'unsafe-inline'",
            'https://fonts.bunny.net'
        ]);

        $this->addDirective(Directive::FONT, [
            "'self'",
            'https://fonts.bunny.net'
        ]);
    }
}