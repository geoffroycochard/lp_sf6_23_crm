<?php
namespace App\EventListener;
use App\Entity\Opportunity;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;

#[AsEntityListener(
    event: 'prePersist',
    entity: Opportunity::class
)]
#[AsEntityListener(
    event: 'preUpdate',
    entity: Opportunity::class
)]
class OpportunityListener  
{
    public function __invoke(Opportunity $opportunity)
    {
        $estimatedValue = 0;
        foreach ($opportunity->getProducts() as $product) {
            $estimatedValue += $product->getPrice();
        }
        $opportunity->setEstimatedValue($estimatedValue);
    }
}
