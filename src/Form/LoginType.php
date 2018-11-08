<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Translation\TranslatorInterface;

class LoginType extends AbstractType
{
    public function __construct(TranslatorInterface $translator){
        $this->tr = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => $this->tr->trans('Email'), 'attr'=>['id'=>'inputEmail', 'class'=>'form-control']])
            ->add('password', PasswordType::class, ['label'=>$this->tr->trans('Password'), 'attr'=>['id'=>'inputPassword', 'class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
