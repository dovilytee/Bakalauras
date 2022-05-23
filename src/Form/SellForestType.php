<?php

namespace App\Form;

use App\Entity\Forest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SellForestType extends AbstractType
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
            ->add('adress', TextareaType::class,[
                'label' => 'Adresas',
                'attr'=>[
            'placeholder' => 'Įveskite adresą'
                ]
            ])
            ->add('size',TextType::class,[
                'label' => 'Miško dydis',
                'attr'=>[
            'placeholder' => 'Įveskite plotą'
                ]
            ])
            ->add('wood',TextType::class, [
                'label' => 'Medienos tipas',
        'attr'=>[
            'placeholder' => 'Įveskite medienos tipą'
                ]
            ])
            ->add('care',TextType::class,[
                'label' => 'Miško priežiūra',
        'attr'=>[
            'placeholder' => 'Įveskite priežiūrą'
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
            'data_class' => Forest::class,
        ]);
    }
}
