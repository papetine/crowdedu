<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    const LABEL = 'label';
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom', TextType::class)
        ->add('prenom', TextType::class)
        ->add('dateNaissance',TextType::class,array(self::LABEL  => 'Date de naissance'))
        ->add('lieuNaissance', TextType::class,array(self::LABEL  => 'Lieu de naissance'))
         ->add('sexe', ChoiceType::class, [
            'choices'  => [
                'Homme' => 'Homme',
                'Femme' => 'Femme',
            ],
            'expanded' => true,
        ]) 
        ->add('email', EmailType::class)
        ->add('username', TextType::class)
        ->add('password', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options'  => array(self::LABEL => 'Password'),
            'second_options' => array(self::LABEL => 'Repeat Password'),
        ))
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
