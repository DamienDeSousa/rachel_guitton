<?php

namespace App\Form\Provider;

use Symfony\Component\Form\FormInterface;

interface FormProviderInterface
{
    public function getForm(array $options = []): FormInterface;
}