<?php

namespace StageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class indexeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle',null,array('label'=>'libellé','attr'=>array('class'=>'form-control')))
            ->add('description',ChoiceType::class,array('choices'=>array(
                'alimentaire'=>'alimentaire',
                'technologique'=>'technologique',)),array('label'=>'description','attr'=>array('class'=>'form-control')))

            ->add('add_index',SubmitType::class,array('label'=>'Create','attr'=>array('class'=>'btn btn-lg btn-info')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StageBundle\Entity\indexe'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stagebundle_indexe';
    }


}
