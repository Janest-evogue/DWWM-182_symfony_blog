<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                // nom du champ de formulaire correspond au nom
                // de l'attribut dans l'entité
                'name',
                // input type text
                TextType::class,
                // tableau d'options
                [
                    // label custom pour le champ de formulaire
                    'label' => 'Nom'
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Description',
                    // par défaut les champs de formulaire ont l'attribut required
                    'required' => false,
                    // attributs html de la balise du champ de formulaire
                    'attr' => [
                        'rows' => 5,
                        'class' => 'wysiwyg'
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
