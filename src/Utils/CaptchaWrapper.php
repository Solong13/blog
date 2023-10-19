<?php

namespace SoLong\Blog\Utils;

use Gregwar\Captcha\CaptchaBuilder;
use  SoLong\Blog\Core\Session;

class CaptchaWrapper {

    private CaptchaBuilder $captchaBuilder;
    private Session $session;

    public function __construct() 
    {
        $this->captchaBuilder = new CaptchaBuilder();
         $this->captchaBuilder->build();
    
        $this->session = new Session();
    }

    public function getCaptcha(): string {
        $this->session->add('captcha', $this->captchaBuilder->getPhrase());
        return $this->captchaBuilder->inline();
    }
    

    public function checkCaptcha($phrase): bool {
        return $phrase === $this->session->get('captcha');
    }
}