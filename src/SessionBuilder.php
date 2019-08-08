<?php

namespace App;

use PommProject\Foundation\Client\ClientHolder as BaseClientHolder;
use PommProject\Foundation\Converter\ConverterHolder;
use PommProject\Foundation\Converter\PgHstore;
use PommProject\Foundation\Session\Connection;
use PommProject\ModelManager\SessionBuilder as Base;

class SessionBuilder extends Base
{
    /**
     * {@inheritDoc}
     */
    protected function initializeConverterHolder(ConverterHolder $converter_holder)
    {
        parent::initializeConverterHolder($converter_holder);

        $converter_holder
            ->registerConverter('Hstore', new PgHstore(), ['public.hstore'])
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function createSession(Connection $connection, BaseClientHolder $client_holder, $stamp)
    {
        $this->configuration->setDefaultValue('class:session', Session::class);

        return parent::createSession($connection, $client_holder, $stamp);
    }
}
