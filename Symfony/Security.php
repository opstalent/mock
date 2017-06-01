<?php

namespace Opstalent\Mock\Symfony;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @author Patryk Grudniewski <patgrudniewski@gmail.com>
 * @package Opstalent\Mock
 */
final class Security
{
    /**
     * @param mixed $user
     * @return TokenInterface
     */
    public static function mockTokenInterface($user) : TokenInterface
    {
        $token = \Mockery::mock(TokenInterface::class);

        $token
            ->shouldReceive('getUser')
            ->andReturn($user);

        return $token;
    }

    /**
     * @param mixed $user
     * @return TokenStorageInterface
     */
    public static function mockTokenStorageInterface($user) : TokenStorageInterface
    {
        $token = static::mockTokenInterface($user);

        $storage = \Mockery::mock(TokenStorageInterface::class);

        $storage
            ->shouldReceive('getToken')
            ->andReturn($token);

        return $storage;
    }
}
