<?php

namespace Mauretto78\DDD\Application\DataTranformer;

interface DataTranformerInterface
{
    public function write($input);

    public function read();
}