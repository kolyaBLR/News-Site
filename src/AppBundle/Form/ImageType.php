<?php

namespace AppBundle\Form;

use AppBundle\Entity\DataNews;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('category', ChoiceType::class, array(
                'choices' => array(
                    'Finance' => 'Finance',
                    'Weather' => 'Weather',),
            ))
            ->add('titleText', TextType::class)
            ->add('content', TextType::class)
            ->add('titleImage', FileType::class, array(
                'label' => 'Upload foto'));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DataNews::class,
        ));
    }
}