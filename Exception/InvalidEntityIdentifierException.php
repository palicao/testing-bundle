<?php

/**
 * This file is part of the "cosma/testing-bundle" project
 *
 * (c) Cosmin Voicu<cosmin.voicu@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Date: 11/07/14
 * Time: 23:33
 */
namespace Cosma\Bundle\TestingBundle\Exception;

class InvalidEntityIdentifierException extends \Exception
{
    /**
     * @param string $entity
     * @param string $identifier
     */
    public function __construct($entity, $identifier)
    {
        $message =  "Entity {$entity} does not have identifier {$identifier}";

        parent::__construct($message);
    }
}