<?php
namespace App\DoctrineType;
use App\Enum\OpportunityStatus;


class OpportunityStatusType extends AbstractEnumType
{
    public const NAME = 'opportunity_status';

    public function getName(): string // the name of the type.
    {
        return self::NAME;
    }

    public static function getEnumsClass(): string // the enums class to convert
    {
        return OpportunityStatus::class;
    }
}