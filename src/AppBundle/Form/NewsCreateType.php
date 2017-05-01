<?php

namespace AppBundle\Form;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\NewsCategory;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NewsCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:NewsCategory',
                'choice_label' => 'category',
            ))
            ->add('nameNews', TextType::class)
            ->add('titleText', TextType::class)
            ->add('content', TextareaType::class)
            ->add('linkNews1', TextType::class, array(
                'required' => false,
            ))
            ->add('linkNews2', TextType::class, array(
                'required' => false,
            ))
            ->add('linkNews3', TextType::class, array(
                'required' => false,
            ))
            ->add('linkNews4', TextType::class, array(
                'required' => false,
            ))
            ->add('linkNews5', TextType::class, array(
                'required' => false,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DataNews::class,
        ));
    }
}