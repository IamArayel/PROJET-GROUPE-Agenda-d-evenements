<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom complet',
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre nom.'),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'constraints' => [
                    new NotBlank(message: 'Veuillez renseigner votre adresse mail.'),
                    new Email(message: 'Veuillez renseigner un email valide.'),
                ],
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Numéro de téléphone',
                'required' => false
            ])
            ->add('nombrePlaces', IntegerType::class, [
                'label' => 'Nombre de places',
                'attr' => ['min' => 1, 'max' => 10],
                'constraints' => [
                    new NotBlank(message: 'Veuillez indiquer le nombre de places.'),
                    new Range(
                        min: 1,
                        max: 10,
                        notInRangeMessage: 'Le nombre de places doit être entre {{ min }} et {{ max }}.'
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
