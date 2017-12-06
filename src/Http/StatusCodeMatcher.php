<?php
namespace DerekHamilton\Glove\Http;

use Illuminate\Contracts\Container\Container;
use Exception;

class StatusCodeMatcher
{
    /** @var array */
    private $codes;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->codes = $container->config->get('glove.statusCodes', []);
    }

    /**
     * @param Exception $e
     * @return integer
     */
    public function match(Exception $e)
    {
        foreach ($this->codes as $exception => $code) {
            if ($e instanceof $exception) {
                return $code;
            }
        }

        return 500;
    }
}
