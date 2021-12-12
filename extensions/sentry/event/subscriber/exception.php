<?php
/**
 * Joomlatools Pages
 *
 * @copyright   Copyright (C) 2018 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/joomlatools/joomlatools-pages for the canonical source repository
 */

class ExtSentryEventSubscriberException extends ComPagesEventSubscriberAbstract
{
    protected function _initialize(KObjectConfig $config)
    {
        $config->append($this->getObject('ext:sentry.config'));

        parent::_initialize($config);
    }

    public function onBeforeDispatcherDispatch(KEventInterface $event)
    {
        if($this->getConfig()->init && $this->getConfig()->dsn)
        {
            //Initialise Options
            $options = [
                'dsn'                => $this->getConfig()->dsn,
                'environment'        => $this->getConfig()->environment,
                'traces_sample_rate' => $this->getConfig()->traces_sample_rate,
                'release'            => $this->getConfig()->release,
                'logger'             => 'php.pages',
            ];

            if(is_callable($this->getConfig()->init)) {
                $options = call_user_func($this->getConfig()->init, $options);
            }

            \Sentry\init($options);

            //Configure Scope
            \Sentry\configureScope(function (\Sentry\State\Scope $scope): void
            {
                foreach($this->getConfig()->tags as $key => $value) {
                    $scope->setTag($key, $value);
                }

                if(is_callable($this->getConfig()->scope)) {
                    call_user_func($this->getConfig()->scope, $scope);
                }
            });

        }
    }

    public function onException(KEventInterface $event)
    {
        $exception = $event->exception;
        \Sentry\captureException($exception);
    }

    public function isEnabled()
    {
        return function_exists('\Sentry\captureException') && parent::isEnabled();
    }
}