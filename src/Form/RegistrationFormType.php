<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nom', TextType::class,[
                'label'=> "Nom * : ",
                'attr' => [
                 'class' => 'd-block form-control mb-3',
        ],

            ])
            ->add('prenom', TextType::class,[
                'label'=> "Prénom * : ",
                         'attr' => [
        'class' => 'd-block form-control mb-3',
    ]
            ])
            ->add('email', TextType::class,[
                'label'=> "Email * : ",
                'attr' => [
                    'class' => 'd-block form-control mb-3',
                ]
            ])

            ->add('pseudo', TextType::class,[
                'label'=> "Pseudo * : ",
                'attr' => [
                    'class' => 'd-block form-control mb-3',
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,

                'label'=> 'Condition d\'utilisation* : ',
                'attr' => [
                    'class' => 'ml-3 mb-3',
                ],
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuiller cocher la case.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                "type"=>PasswordType::class,
                'invalid_message'=>'Les mots de passe ne correspondent pas,',
                'required'=>true,
                'first_options'  => ['label' => 'Mot de passe * : ',   'attr' => [
                    'class' => 'd-block form-control mb-3',
                ],],
                'second_options' => ['label' => 'Confirmer le mot de passe * : ',   'attr' => [
                    'class' => 'd-block form-control mb-3',
                ],],

                'constraints' => [
                    new Assert\Regex([
                        'pattern'=>'/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',
                        'message'=>'Le mots de passe doit être de 8 caracteres avec 1 majuscule, 1 minuscule et 1 nombre'
                    ])

                ],

                'attr' => ['autocomplete' => 'new-password'],

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            "required"=>false,
            'data_class' => User::class,
        ]);
    }
}
