<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null, ["label" => "Pseudo"])
            ->add('phoneNumber', null, ["label" => "Numéro de téléphone" ])
            ->add('mail',EmailType::class)
            ->add('password', RepeatedType::class, [
                'type'=>PasswordType::class,
                'first_options' => ['label' =>'Mot de passe'],
                'second_options' => ['label'=>'Encore'],
                'invalid_message'=>'Vos mots de passe doivent correspondrent'

            ])
            ->add('localite')
            ->add('image', FileType::class,[
                'label'=>'Ajouter une image',
                'required'=>true,
                'mapped'=>false,
            ]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
