<?php
/**
 * @copyright	Copyright (C) 2007 - 2015 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		Mozilla Public License, version 2.0
 * @link		http://github.com/joomlatools/joomlatools-console for the canonical source repository
 */

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Folioshell\Command\AbstractSite;

/**
 * Creates a certificate for the given site using Minica.
 * 
 * It tries to create a new certificate for the site first. 
 * If it exists (returning 409 Conflict) it tries to renew the certificate if it's close to expiry. 
 */
class CertCreate extends AbstractSite
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('cert:create')
            ->setAliases(['site:create:cert'])
            ->setDescription('Creates a new Minica certificate')
        ;
    }

    protected function _callMinica($method, $path) 
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_URL, "http://minica/$path");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        $info = curl_getinfo($ch);

        $result = [
            'http_code' => $info['http_code'],
            'isSuccess' => $info['http_code'] === 200,
            'isConflict' => $info['http_code'] === 409,
            'response'  => $info['content_type'] === 'application/json' ? json_decode($result, true) : $result
        ];

        return $result;
    }

    protected function _createCert($domain, OutputInterface $output) 
    {
        $post = $this->_callMinica('POST', "certs/$domain");

        if ($post['isSuccess']) {
            $output->writeln("<info>Certificate created for {$post['response']['domain']}</info>");
        } 
        else 
        {
            if ($post['isConflict']) 
            {
                $put = $this->_callMinica('PUT', "certs/$domain");

                if ($put['isConflict']) 
                {
                    if ($put['response']['detail']['message'] === 'Certificate not due for expiry') {
                        $output->writeln("<info>Certificate already exists and is not due for expiry</info>");
                    } else {
                        $output->writeln("<error>{$put['response']['detail']['message']}</error>");
                    }
                }
            } 
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        $this->_createCert("{$this->site}.test", $output);
        $this->_createCert("www.{$this->site}.test", $output);

        return 0;
    }

}
