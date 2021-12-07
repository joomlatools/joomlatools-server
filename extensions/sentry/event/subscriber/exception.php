<?php

class ExtSentryEventSubscriberException extends ComPagesEventSubscriberAbstract
{
    public function onException(KEvent $event)
    {
        $exception = $event->exception;

        if($exception->getCode() >= 500) {
            \Sentry\captureException($exception);
        }
    }

    public function isEnabled()
    {
        return getenv('SENTRY_DSN') && function_exists('\Sentry\captureException') && parent::isEnabled();
    }
}