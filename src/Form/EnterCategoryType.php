<?php
/**
 * Created by PhpStorm.
 * User: ЮРИЙ
 * Date: 12.01.2019
 * Time: 21:52
 */

namespace App\Form;


use App\Entity\NewsCategory;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnterCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newsCategories', EntityType::class, [
                'label' => 'Категории новостей',
                'class' => NewsCategory::class,
                'expanded' => true,
                'multiple' => true,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}