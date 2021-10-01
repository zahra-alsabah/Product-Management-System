<?php

namespace StageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name',null,array('label'=>'Name','attr'=>array('class'=>'form-control')))
                ->add('email',null,array('label'=>'email','attr'=>array('class'=>'form-control')))
                ->add('adress',null,array('label'=>'adress','attr'=>array('class'=>'form-control')))
                ->add('tel',null,array('label'=>'tel','attr'=>array('class'=>'form-control')))
                ->add('add_user',SubmitType::class,array('label'=>'Create','attr'=>array('class'=>'btn btn-lg btn-info')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StageBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stagebundle_user';
    }


}
