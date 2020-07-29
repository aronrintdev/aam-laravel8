<?php
namespace App\Transformers;

use App\Models\Academy;
use App\Models\Account;
use App\Models\Instructor;
use App\Models\SearchResult;
use App\User;
use Neomerx\JsonApi\Schema\BaseSchema;
use Neomerx\JsonApi\Contracts\Schema\ContextInterface;


/**
 * @OA\Schema(
 *   schema="instructor-search-result",
 *   required={""},
 *   @OA\Property(
 *     property="id",
 *     description="AccountID",
 *     type="integer"
 *   ),
 *   @OA\Property(
 *     property="type",
 *     description="user",
 *     default="instructor",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="attributes",
 *     type="object",
 *       @OA\Property(
 *         property="first_name",
 *         description="First Name",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="last_name",
 *         description="Last Name",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="profile_pic",
 *         description="Profile Pic URL",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="email",
 *         description="Email",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="account_type",
 *         description="'user' or 'instructor'",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="academy_code",
 *         description="Currently selected academy ID (instructor only)",
 *         type="string"
 *       ),
 *       @OA\Property(
 *         property="academy_owner",
 *         description="1 or 0 if the instructor is owner of current academy",
 *         type="string"
 *       ),
 *   ),
 *   @OA\Property(
 *     property="relationships",
 *     description="1 or 0 if the instructor is owner of current academy",
 *     type="object",
 *     @OA\Property(
 *       property="academies",
 *       type="object",
 *       @OA\Property(
 *         type="array",
 *         property="data",
 *         @OA\Items(
 *           @OA\Property(
 *             type="string",
 *             property="id",
 *           ),
 *           @OA\Property(
 *             type="string",
 *             property="type",
 *           ),
 *         ),
 *       ),
 *     ),
 *   ),
 * )
 */

class InstructorSearchResultSchema extends BaseSchema
{
    public function getType(): string
    {
        return 'instructor';
    }

    public function getId($user): string
    {
        return $user->id;
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

    public function getAttributes($user, ContextInterface $context): iterable
    {
        //$avatarUrl = $acct->avatar ? $acct->avatar->AvatarURL : null;
        $avatarUrl = $user->HeadShot;
        if ($avatarUrl == null || $avatarUrl == 'NotAvailable.gif') {
            $avatarUrl = 'https://vos-media.nyc3.cdn.digitaloceanspaces.com/profile/profile_empty.png';
        }
        return [
            'first_name'    => $user->FirstName,
            'last_name'     => $user->LastName,
            'profile_pic'   => $avatarUrl,
            'email'         => $user->Email,
            'account_type'  => 'instructor',
            'title'         => $user->Title,
            'academy_code'    => trim($user->AcademyID),
            'instructor_id'    => trim($user->AccountID),
        ];
    }

    public function getRelationships($user, ContextInterface $context): iterable
    {
        $academy = \Cache::remember('academy-'.$user->AcademyID, 3600, function() use ($user) {
            return Academy::find($user->AcademyID);
        });
        return [
            'academies' => [
                self::RELATIONSHIP_DATA          => $academy,
                self::RELATIONSHIP_LINKS_SELF    => false,
                self::RELATIONSHIP_LINKS_RELATED => false,
            ],
        ];

        //regular user accounts have no relationships
        return [];
    }
}
