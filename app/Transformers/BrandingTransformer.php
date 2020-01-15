<?php
namespace App\Transformers;

use App\Models\Academy;
use League\Fractal;


/**
 * @OA\Schema(
 *   schema="Branding",
 *   required={""},
 *   @OA\Property(
 *     property="banner_graphic",
 *     description="banner_graphic",
 *     default="/images/ludwig-schreier-1081991-unsplash.jpg",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="logo",
 *     description="logo",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="base_color",
 *     description="base_color",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="base_color_lt",
 *     description="base_color_lt",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="selected_color",
 *     description="selected_color",
 *     type="string"
 *   ),
 *   @OA\Property(
 *     property="btn_color",
 *     description="btn_color",
 *     type="string"
 *   ),
 * )
 */

/**  // TODO
 *   OA\Property(
 *     property="CreatedWebURL",
 *     description="CreatedWebURL",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="SampleLesson",
 *     description="SampleLesson",
 *     type="integer",
 *          format="int32"
 *   ),
 *   OA\Property(
 *     property="BodyText",
 *     description="BodyText",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="SelectedColorMed",
 *     description="SelectedColorMed",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="FB_URL_Long",
 *     description="FB_URL_Long",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="BaseColorMed",
 *     description="BaseColorMed",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="TopTextSelectedColor",
 *     description="TopTextSelectedColor",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="TopTextBaseColor",
 *     description="TopTextBaseColor",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="YT_UserName",
 *     description="YT_UserName",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="FrontPageText2",
 *     description="FrontPageText2",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="BG_LightDark",
 *     description="BG_LightDark",
 *     type="integer",
 *          format="int32"
 *   ),
 *   OA\Property(
 *     property="FrontPageText1",
 *     description="FrontPageText1",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="SelectedColorLt",
 *     description="SelectedColorLt",
 *     type="string"
 *   ),
 *   OA\Property(
 *     property="BannerText",
 *     description="BannerText",
 *     type="string"
 *   ),
 */

class BrandingTransformer extends Fractal\TransformerAbstract
{
	public function transform(Academy $acct)
	{
	    return [
	        'id'         => $acct->AcademyID,
	        'type'       => 'branding',
            'attributes' => [
                'banner_graphic' =>  $acct->LogInGraphic,
                'banner_text'    =>  $acct->BannerText,
                'logo'           =>  $acct->Logo,
                'base_color'     =>  $acct->BaseColor,
                'base_color_lt'  =>  $acct->BaseColorLt,
                'btn_color'      =>  $acct->BGColor,
                'selected_color' =>  $acct->SelectedColor,
            ]
	    ];
	}
}
