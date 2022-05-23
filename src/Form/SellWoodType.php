<?php

namespace App\Form;

use App\Entity\Wood;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellWoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'Miestas',
                'attr'=>[
                    'placeholder' => 'Įveskite miestą'
                ]
            ])
            ->add('address', TextareaType::class,[
                'label' => 'Adresas',
                'attr'=>[
                    'placeholder' => 'Įveskite adresą'
                ]
            ])
            ->add('count',TextType::class,[
                'label' => 'Kiekis',
                'attr'=>[
                    'placeholder' => 'Įveskite plotą'
                ]
            ])
            ->add('wood_type',TextType::class, [
                'label' => 'Medienos tipas',
                'attr'=>[
                    'placeholder' => 'Įveskite medienos tipą'
                ]
            ])
            ->add('Ikelti', SubmitType::class,[
                'attr'=>[
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Wood::class,
        ]);
    }
}
