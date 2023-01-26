<?php

namespace App\Form;

use App\Entity\Opportunity;
use App\Enum\OpportunityStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpportunityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('topic')
            ->add('date')
            ->add('status', EnumType::class, [
                'class' => OpportunityStatus::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Opportunity::class,
        ]);
    }
}
