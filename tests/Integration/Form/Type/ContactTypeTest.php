<?php

namespace App\Tests\Integration\Form\Type;

use App\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ContactTypeTest extends KernelTestCase
{
    private const FIELDS_TO_TEST = [
        'name' => [
            'type' => TextType::class,
            'constraints' => [
                NotBlank::class,
                Type::class,
            ]
        ],
        'email' => [
            'type' => EmailType::class,
            'constraints' => [
                NotBlank::class,
                Email::class,
            ]
        ],
        'message' => [
            'type' => TextareaType::class,
            'constraints' => [
                NotBlank::class,
                Type::class,
            ],
        ]
    ];

    public function testBuildForm(): void
    {
        static::bootKernel();
        /** @var FormFactoryInterface $formFactory */
        $formFactory = static::getContainer()->get(FormFactoryInterface::class);
        $builder = $formFactory->createBuilder();
        /** @var ContactType $contactType */
        $contactType = static::getContainer()->get(ContactType::class);
        $contactType->buildForm($builder, []);

        foreach (self::FIELDS_TO_TEST as $fieldName => $fieldInformation) {
            $field = $builder->get($fieldName);
            $this->assertInstanceOf($fieldInformation['type'], $field->getType()->getInnerType());
            foreach ($field->getOptions()['constraints'] as $constraint) {
                $this->assertContains(get_class($constraint), $fieldInformation['constraints']);
            }
        }
    }
}
