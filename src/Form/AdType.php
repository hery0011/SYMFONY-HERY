<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label'=>'nom',
                'attr'=> ['class'=>'form-control', 'placeholder'=>'votre nom']
            ])
            ->add('prenom', TextType::class, [
                'label'=>'prenom',
                'attr'=>['class'=>'form-control', 'placeholder'=>'votre prenom']
            ])
            ->add('mail', EmailType::class, [
                'label'=>'email',
                'attr'=>['class'=>'form-control', 'placeholder'=>'votre email']
            ])
            ->add('password', PasswordType::class, [
                'label'=>'password',
                'attr'=>['class'=>'form-control', 'placeholder'=>'votre password']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
