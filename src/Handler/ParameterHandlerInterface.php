<?php

namespace MediaMonks\SonataMediaBundle\Handler;

use MediaMonks\SonataMediaBundle\Model\MediaInterface;
use MediaMonks\SonataMediaBundle\ParameterBag\ParameterBagInterface;

interface ParameterHandlerInterface
{
    public function getRouteParameters(MediaInterface $media, ParameterBagInterface $parameterBag): array;

    public function validateParameterBag(MediaInterface $media, ParameterBagInterface $parameterBag): ParameterBagInterface;
}
