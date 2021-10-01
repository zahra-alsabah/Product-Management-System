<?php

namespace StageBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('url',null,array('label'=>'Url','attr'=>array('class'=>'form-control')))
            ->add('username',null,array('label'=>'username','attr'=>array('class'=>'form-control')))
            ->add('mdp',null,array('label'=>'mdp','attr'=>array('class'=>'form-control')))
            ->add('port',null,array('label'=>'port','attr'=>array('class'=>'form-control')))
            ->add('add_index',SubmitType::class,array('label'=>'Create','attr'=>array('class'=>'btn btn-lg btn-info')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'StageBundle\Entity\Server'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'stagebundle_server';
    }


}
