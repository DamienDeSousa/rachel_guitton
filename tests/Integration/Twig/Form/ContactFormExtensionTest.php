<?php

namespace App\Tests\Integration\Twig\Form;

use App\Form\Provider\LazyContactFormProvider;
use App\Twig\Form\ContactFormExtension;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\FormView;
use Twig\Environment;

class ContactFormExtensionTest extends KernelTestCase
{
    private const FIELDS = ['name', 'email', 'message', '_token'];
    public function testGetForm(): void
    {
        static::bootKernel();
        /** @var Environment $twig */
        $twig = static::getContainer()->get('twig');
        $twigFunction = $twig->getFunction('get_contact_form');
        $getForm = $twigFunction->getCallable();
        /** @var FormView $form */
        $form = $getForm();

        $this->assertEquals('contact', $form->vars['id']);
        foreach (self::FIELDS as $field) {
            $this->assertInstanceOf(FormView::class, $form->offsetGet($field));
        }
    }
}