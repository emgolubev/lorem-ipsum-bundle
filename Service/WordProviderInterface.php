<?php


namespace KnpU\LoremIpsumBundle\Service;


/**
 * Interface WordProviderInterface
 * @package KnpU\LoremIpsumBundle\Service
 */
interface WordProviderInterface
{
    public function getWordList(): array;
}