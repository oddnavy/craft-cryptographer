<?php

namespace miranj\cryptographer\twigextensions;

use Craft;
use Craft\web\twig\Environment;
use miranj\cryptographer\Plugin;
use Twig_Extension;
use Twig_Filter;
use Twig_Markup;

class CryptographerTwigExtension extends Twig_Extension
{
    public function getName()
    {
        return Craft::t('Cryptographer');
    }
    
    public function getFilters()
    {
        $needs_env = ['needs_environment' => true];
        return [
            new Twig_Filter('encrypt_legacy', [$this, 'legacyEncryptFilter'], $needs_env),
            new Twig_Filter('decrypt_legacy', [$this, 'legacyDecryptFilter'], $needs_env),
        ];
    }
    
    /**
    * DEPRECATED
    * 
    * Twig wrapper for legacyEncrypt
    */
    public function legacyEncryptFilter(Environment $env, $plaintext, $method='AES-256-CBC', $iv=null)
    {
        $charset = $env->getCharset();
        $data = Plugin::getInstance()->cryptographer->legacyEncrypt($plaintext, $method, $iv);
        return new Twig_Markup($data, $charset);
    }
    
    /**
    * DEPRECATED
    * 
    * Twig wrapper for legacyDecrypt
    */
    public function legacyDecryptFilter(Environment $env, $data, $method='AES-256-CBC')
    {
        $charset = $env->getCharset();
        $plaintext = Plugin::getInstance()->cryptographer->legacyDecrypt($data, $method);
        return new Twig_Markup($plaintext, $charset);
    }
    
}
