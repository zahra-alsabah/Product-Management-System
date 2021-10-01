<?php

namespace StageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class regleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libelle',null,array('label'=>'libellé','attr'=>array('class'=>'form-control')))
            ->add('description',null,array('label'=>'description','attr'=>array('class'=>'form-control')))

            ->add('add_regle',SubmitType::class,array('label'=>'Create','attr'=>array('class'=>'btn btn-lg btn-info')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StageBundle\Entity\regle'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stagebundle_regle';
    }


}
