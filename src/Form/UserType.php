<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Email should not be blank']),
                    new Email(['message' => 'Invalid Email']),
                ]
            ])
            ->add('roles', CollectionType::class, [
                'constraints' => [
                    new Choice(['choices' => User::AVAILABLE_ROLES, 'multipleMessage' => 'Invalid field user role', 'multiple' => true])
                ],
            ]);

        if ($options['validation_groups'][0] === 'edit') {
            return;
        }

        $builder->add('password', PasswordType::class, [
            'constraints' => [
                new NotBlank(['message' => 'Email should not be blank']),
            ],
        ]);

        $builder
            ->get('password')
            ->addModelTransformer(new CallbackTransformer(
                function ($password) { return $password; },
                function ($password) {
                    if (is_null($password)) {
                        return $password;
                    }

                    return $this->encoder->encodePassword(new User(), $password);
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
            'validation_groups' => ['create', 'edit'],
        ]);
    }
}
