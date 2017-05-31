<?php

namespace Opstalent\Mock\Symfony;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author Patryk Grudniewski <patgrudniewski@gmail.com>
 * @package Opstalent\Mock
 */
final class HttpFoundation
{
    /**
     * @param array $attributes
     * @return Request
     */
    public static function mockRequest(array $attributes = []) : Request
    {
        $attributesBag = \Mockery::mock(ParameterBag::class);

        $attributesBag
            ->shouldReceive('get')
            ->andReturnUsing(function($key) use ($attributes) {
                return array_key_exists($key, $attributes) ? $attributes[$key] : null;
            });

        $request = \Mockery::mock(Request::class);
        $request->attributes = $attributesBag;

        return $request;
    }
}
