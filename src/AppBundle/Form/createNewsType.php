<?php

namespace AppBundle\Form;

use AppBundle\Entity\DataNews;
use AppBundle\Entity\NewsCategory;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class createNewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, array(
                'class' => 'AppBundle:NewsCategory',
                'choice_label' => 'category',
            ))
            ->add('titleText', TextType::class)
            ->add('content', TextType::class);
            //->add('titleImage', FileType::class, array(
             //   'label' => 'Upload photo'));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DataNews::class,
        ));
    }
}