<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends PasswordResetType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options)
        {
        $builder->add('plainPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options' => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('userName', TextType::class)
            ->add('lastName', TextType::class)
        };
    }
}