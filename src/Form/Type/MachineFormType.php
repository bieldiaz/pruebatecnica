<?php

namespace App\Form\Type;

use App\Entity\Machine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MachineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Brand', TextType::class);
        $builder->add('Model', TextType::class);
        $builder->add('Manufacturer', TextType::class);
        $builder->add('Price', IntegerType::class);
        $builder->add('Images', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Machine::class,
        ]);
    }

    public function getMachinePrefix()
    {
        return '';
    }

    public function getName()
    {
        return '';
    }
}
