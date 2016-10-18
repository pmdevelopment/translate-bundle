<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 17.10.2016
 * Time: 12:32
 */

namespace PM\Bundle\TranslateBundle\Services;

use Google\Cloud\Translate\TranslateClient;

/**
 * Class TranslationService
 *
 * @package PM\Bundle\TranslateBundle\Services
 */
class TranslationService
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $defaultLanguageFrom;

    /**
     * @var string
     */
    private $defaultLanguageTo;

    /**
     * @var Google_Client
     */
    private $client;

    /**
     * TranslationService constructor.
     *
     * @param string $defaultLanguageFrom
     * @param string $defaultLanguageTo
     * @param string $apiKey
     */
    public function __construct($defaultLanguageFrom, $defaultLanguageTo, $apiKey)
    {
        $this->defaultLanguageFrom = $defaultLanguageFrom;
        $this->defaultLanguageTo = $defaultLanguageTo;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getDefaultLanguageFrom()
    {
        return $this->defaultLanguageFrom;
    }

    /**
     * @return string
     */
    public function getDefaultLanguageTo()
    {
        return $this->defaultLanguageTo;
    }


    /**
     * @return Google_Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }


    /**
     * @param string      $text
     * @param string|null $languageFrom
     * @param string|null $languageTo
     *
     * @return mixed
     */
    public function translate($text, $languageFrom = null, $languageTo = null)
    {
        if (false === ($this->getClient() instanceof TranslateClient)) {
            $this->createClient();
        }

        if (null === $languageFrom) {
            $languageFrom = $this->getDefaultLanguageFrom();
        }

        if (null === $languageTo) {
            $languageTo = $this->getDefaultLanguageTo();
        }

        $client = $this->getClient();

        $translation = $client->translate($text, [
            'source' => $languageFrom,
            'target' => $languageTo,
        ]);

        if (true === isset($translation['text'])) {
            return $translation['text'];
        }

        return $text;
    }

    /**
     * Creating Client
     *
     * @return $this
     */
    private function createClient()
    {
        $client = new TranslateClient(
            [
                'key' => $this->getApiKey(),
            ]
        );

        $this->client = $client;

        return $this;
    }
}