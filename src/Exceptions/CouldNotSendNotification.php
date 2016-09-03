<?php

namespace NotificationChannels\Telegram\Exceptions;

use GuzzleHttp\Exception\ClientException;

class CouldNotSendNotification extends \Exception
{
    /**
     * Thrown when there's a bad request and an error is responded.
     *
     * @param ClientException $exception
     *
     * @return static
     */
    public static function serviceRespondedWithAnError(ClientException $exception)
    {
        $statusCode  = $exception->getResponse()->getStatusCode();
        $description = 'no description given';

        if ($result = json_decode($exception->getResponse()->getBody())) {
            $description = $result->description ?: $description;
        }

        return new static("Zenvia responded with an error `{$statusCode} - {$description}`");
    }

    /**
     * Thrown when we're unable to communicate with Zenvia.
     *
     * @return static
     */
    public static function couldNotCommunicateWithZenvia()
    {
        return new static('The communication with Zenvia failed.');
    }

    /**
     * Thrown when there is no 'conta' provided.
     *
     * @return static
     */
    public static function contaNotProvided()
    {
        return new static('Zenvia account not provided');
    }

    /**
     * Thrown when there is no 'senha' provided
     *
     * @return static
     */
    public static function senhaNotProvided()
    {
        return new static('Zenvia password not provided');
    }
}
