<?php
namespace App\Transformers;

use App\Models\Account;
use App\Models\Instructor;
use App\Models\Academy;
use Neomerx\JsonApi\Schema\BaseSchema;
use Neomerx\JsonApi\Contracts\Schema\ContextInterface;
use Neomerx\JsonApi\Contracts\Schema\LinkInterface;



class AcademySchema extends BaseSchema
{
    public function getType(): string
    {
        return 'academy';
    }

    public function getId($user): string
    {
        return $user->AcademyID;
    }

    /**
     * @inheritdoc
     */
    public function isAddSelfLinkInRelationshipByDefault(string $relationshipName): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function isAddRelatedLinkInRelationshipByDefault(string $relationshipName): bool
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getLinks($resource): iterable
    {
		return [];
    }

    public function getAttributes($resource, ContextInterface $context): iterable
    {
        return [
			'name'           =>  $resource->Name,
			'banner_graphic' =>  $resource->LogInGraphic,
			'banner_text'    =>  $resource->BannerText,
			'logo'           =>  $resource->Logo,
			'base_color'     =>  $resource->BaseColor,
			'base_color_lt'  =>  $resource->BaseColorLt,
			'btn_color'      =>  $resource->BGColor,
			'selected_color' =>  $resource->SelectedColor,
        ];
    }

    public function getRelationships($user, ContextInterface $context): iterable
    {
        return [];
    }
}
