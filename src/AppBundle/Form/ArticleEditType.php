<?php

namespace AppBundle\Form;

use AppBundle\Entity\Taille;
use AppBundle\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('type',EntityType::class,[
                'mapped'=>false,
                'class' => Type::class,
                "choice_label" => 'libelle',
            ])
            ->add('taille', EntityType::class, [
                'label'=> 'Taille',
                'class' => Taille::class,
                "choice_label" => 'libelle',
            ])
            ->add('marque')

            ->add('description')
            ->add('caution')
            ->add('aVendre',CheckboxType::class,[
                'label'    => 'A vendre ?',
                'required' => false,
            ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_article';
    }


}
