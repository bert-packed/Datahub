<?php

namespace DataHub\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use DataHub\UserBundle\Document\User;
use DataHub\UserBundle\DTO\ProfileCreateData;

class ProfileCreateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username', null, [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'firstName', null, [
                    'label' => 'First name',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'lastName', null, [
                    'label' => 'Last name',
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'email', EmailType::class, [
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'roles', ChoiceType::class, [
                    'choices'  => [
                        'Manager' => 'ROLE_MANAGER',
                        'Consumer' => 'ROLE_CONSUMER',
                    ],
                    'required' => false,
                    'empty_data' => 'ROLE_CONSUMER',
                    'multiple' => true,
                    // *this line is important*
                    'choices_as_values' => true,
                    'attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'plainPassword', RepeatedType::class, [
                    'options' => [
                        'attr' => [
                            'class' => 'form-control'
                        ]
                    ],
                    'type' => PasswordType::class,
                    'required' => $options['create'],
                    'first_options'  => [
                        'label' => 'Password'
                    ],
                    'second_options' => [
                        'label' => 'Repeat Password'
                    ]
                ]
            )
            ->add(
                'newUserBtn', SubmitType::class, [
                    'label' => $options['submitLabel'], 
                    'attr' => [
                        'class' => 'btn btn-lg btn-success btn-block'
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => ProfileCreateData::class,
                'create'     => true,
                'submitLabel' => 'New user',
            ]
        );
    }
}


