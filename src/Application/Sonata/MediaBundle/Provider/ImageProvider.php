<?php

namespace Application\Sonata\MediaBundle\Provider;

use Sonata\MediaBundle\Provider\FileProvider as BaseFileProvider;
use Symfony\Component\Form\FormBuilder;
use Sonata\MediaBundle\Provider\ImageProvider as ImageProviderSonata;

class ImageProvider extends ImageProviderSonata
{
    /**
     * {@inheritdoc}
     */
    public function buildMediaType(FormBuilder $formBuilder)
    {
        $formBuilder->add('binaryContent', 'file', array(
            'label' => false,
        ));
    }
}