<?php

namespace App\Form\Type;

use App\Entity\Libro;
use App\Entity\Editorial;
use App\Entity\Autor;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextType::class)
            ->add('sinopsis', TextareaType::class)
            ->add('n_paginas', TextType::class)
            ->add('editoriales_id', EntityType::class, [
                'label' => 'Editoriales',
                'class' => Editorial::class,
                'choice_label' => 'nombre',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('autores_id', EntityType::class, [
                'label' => 'Autores',
                'class' => Autor::class,
                'choice_label' => function (Autor $autor) {
                    return $autor->getFullName();
                },
                'multiple' => true,
                'expanded' => false
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
}