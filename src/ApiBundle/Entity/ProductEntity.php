<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductEntity
 *
 * @ORM\Table(name="Recipe")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ProductEntityRepository")
 */
class ProductEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Brand_id", type="integer", nullable=false)
     */
    private $brandId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Recipegroup_id", type="integer", nullable=true)
     */
    private $recipegroupId;

    /**
     * @var string
     *
     * @ORM\Column(name="Recipeid", type="string", length=255, nullable=true)
     */
    private $recipeid;

    /**
     * @var integer
     *
     * @ORM\Column(name="beans_origins_tid", type="integer", nullable=true)
     */
    private $beansOriginsTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="colour_tid", type="integer", nullable=true)
     */
    private $colourTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="content_tid", type="integer", nullable=true)
     */
    private $contentTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="description_tid", type="integer", nullable=false)
     */
    private $descriptionTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="extrainfo_tid", type="integer", nullable=true)
     */
    private $extrainfoTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="fabric_tid", type="integer", nullable=true)
     */
    private $fabricTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="howtouse_tid", type="integer", nullable=true)
     */
    private $howtouseTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="legal_denomination_tid", type="integer", nullable=true)
     */
    private $legalDenominationTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="mainfeature_tid", type="integer", nullable=true)
     */
    private $mainfeatureTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="mto_tid", type="integer", nullable=true)
     */
    private $mtoTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="name_tid", type="integer", nullable=false)
     */
    private $nameTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="originofnuts_tid", type="integer", nullable=true)
     */
    private $originofnutsTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="search_keywords_tid", type="integer", nullable=true)
     */
    private $searchKeywordsTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="seo_description_tid", type="integer", nullable=true)
     */
    private $seoDescriptionTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="seo_title_tid", type="integer", nullable=true)
     */
    private $seoTitleTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="size_tid", type="integer", nullable=true)
     */
    private $sizeTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="tastedescription_tid", type="integer", nullable=true)
     */
    private $tastedescriptionTid;

    /**
     * @var string
     *
     * @ORM\Column(name="alcohol_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $alcoholPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="almonds_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $almondsPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="apple_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $applePercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="apricot_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $apricotPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="butter_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $butterPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="cacao_butter_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cacaoButterPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="cacao_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cacaoPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="caramel_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $caramelPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="cereals_biscuitees_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cerealsBiscuiteesPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="chocolate_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $chocolatePercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="cocoa_powder_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cocoaPowderPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="cream_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $creamPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="dairy_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dairyPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="fat_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $fatPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="fruit_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $fruitPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="hazelnut_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $hazelnutPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="maltitol_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $maltitolPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="milk_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $milkPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="nut_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $nutPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="pecan_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $pecanPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="pistachios_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $pistachiosPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="raspberry_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $raspberryPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="sugar_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $sugarPercentage;

    /**
     * @var string
     *
     * @ORM\Column(name="vegetable_fat_percentage", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $vegetableFatPercentage;

    /**
     * @var float
     *
     * @ORM\Column(name="cocoa_cocoa_butter", type="float", precision=10, scale=0, nullable=true)
     */
    private $cocoaCocoaButter;

    /**
     * @var float
     *
     * @ORM\Column(name="cocoa_fatfree_cocoa", type="float", precision=10, scale=0, nullable=true)
     */
    private $cocoaFatfreeCocoa;

    /**
     * @var float
     *
     * @ORM\Column(name="fat_milkfat", type="float", precision=10, scale=0, nullable=true)
     */
    private $fatMilkfat;

    /**
     * @var float
     *
     * @ORM\Column(name="fat_cocoa_butter", type="float", precision=10, scale=0, nullable=true)
     */
    private $fatCocoaButter;

    /**
     * @var float
     *
     * @ORM\Column(name="milk_fatfree_milk", type="float", precision=10, scale=0, nullable=true)
     */
    private $milkFatfreeMilk;

    /**
     * @var float
     *
     * @ORM\Column(name="milk_milkfat", type="float", precision=10, scale=0, nullable=true)
     */
    private $milkMilkfat;

    /**
     * @var float
     *
     * @ORM\Column(name="aeration_level", type="float", precision=10, scale=0, nullable=true)
     */
    private $aerationLevel;

    /**
     * @var float
     *
     * @ORM\Column(name="coffee", type="float", precision=10, scale=0, nullable=true)
     */
    private $coffee;

    /**
     * @var string
     *
     * @ORM\Column(name="paillete_pur_beurre_percentage", type="string", length=32, nullable=true)
     */
    private $pailletePurBeurrePercentage;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_almond", type="boolean", nullable=true)
     */
    private $tasteAlmond;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_apple", type="boolean", nullable=true)
     */
    private $tasteApple;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_banana", type="boolean", nullable=true)
     */
    private $tasteBanana;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_biscuit", type="boolean", nullable=true)
     */
    private $tasteBiscuit;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_cacao", type="boolean", nullable=true)
     */
    private $tasteCacao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_caramel", type="boolean", nullable=true)
     */
    private $tasteCaramel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_cherry", type="boolean", nullable=true)
     */
    private $tasteCherry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_chocolate", type="boolean", nullable=true)
     */
    private $tasteChocolate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_coconut", type="boolean", nullable=true)
     */
    private $tasteCoconut;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_coffee", type="boolean", nullable=true)
     */
    private $tasteCoffee;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_creamy", type="boolean", nullable=true)
     */
    private $tasteCreamy;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_dark_chocolate", type="boolean", nullable=true)
     */
    private $tasteDarkChocolate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_espresso", type="boolean", nullable=true)
     */
    private $tasteEspresso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_fruits", type="boolean", nullable=true)
     */
    private $tasteFruits;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_hazelnut", type="boolean", nullable=true)
     */
    private $tasteHazelnut;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_lemon", type="boolean", nullable=true)
     */
    private $tasteLemon;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_liquor", type="boolean", nullable=true)
     */
    private $tasteLiquor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_marbled_chocolate", type="boolean", nullable=true)
     */
    private $tasteMarbledChocolate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_marzipan", type="boolean", nullable=true)
     */
    private $tasteMarzipan;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_milk_chocolate", type="boolean", nullable=true)
     */
    private $tasteMilkChocolate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_natural", type="boolean", nullable=true)
     */
    private $tasteNatural;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_natural_flavor", type="boolean", nullable=true)
     */
    private $tasteNaturalFlavor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_neutral", type="boolean", nullable=true)
     */
    private $tasteNeutral;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_nuts", type="boolean", nullable=true)
     */
    private $tasteNuts;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_orange", type="boolean", nullable=true)
     */
    private $tasteOrange;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_pineapple", type="boolean", nullable=true)
     */
    private $tastePineapple;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_pistachivo", type="boolean", nullable=true)
     */
    private $tastePistachivo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_raspberry", type="boolean", nullable=true)
     */
    private $tasteRaspberry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_strawberry", type="boolean", nullable=true)
     */
    private $tasteStrawberry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_vanilla", type="boolean", nullable=true)
     */
    private $tasteVanilla;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste_white_chocolate", type="boolean", nullable=true)
     */
    private $tasteWhiteChocolate;

    /**
     * @var float
     *
     * @ORM\Column(name="bitter", type="float", precision=10, scale=0, nullable=true)
     */
    private $bitter;

    /**
     * @var float
     *
     * @ORM\Column(name="caramel", type="float", precision=10, scale=0, nullable=true)
     */
    private $caramel;

    /**
     * @var float
     *
     * @ORM\Column(name="cocoa_taste", type="float", precision=10, scale=0, nullable=true)
     */
    private $cocoaTaste;

    /**
     * @var float
     *
     * @ORM\Column(name="cream", type="float", precision=10, scale=0, nullable=true)
     */
    private $cream;

    /**
     * @var float
     *
     * @ORM\Column(name="floral", type="float", precision=10, scale=0, nullable=true)
     */
    private $floral;

    /**
     * @var float
     *
     * @ORM\Column(name="milk", type="float", precision=10, scale=0, nullable=true)
     */
    private $milk;

    /**
     * @var float
     *
     * @ORM\Column(name="roasted", type="float", precision=10, scale=0, nullable=true)
     */
    private $roasted;

    /**
     * @var float
     *
     * @ORM\Column(name="sour", type="float", precision=10, scale=0, nullable=true)
     */
    private $sour;

    /**
     * @var float
     *
     * @ORM\Column(name="spicy", type="float", precision=10, scale=0, nullable=true)
     */
    private $spicy;

    /**
     * @var float
     *
     * @ORM\Column(name="sweet", type="float", precision=10, scale=0, nullable=true)
     */
    private $sweet;

    /**
     * @var float
     *
     * @ORM\Column(name="vanilla", type="float", precision=10, scale=0, nullable=true)
     */
    private $vanilla;

    /**
     * @var float
     *
     * @ORM\Column(name="vegetal", type="float", precision=10, scale=0, nullable=true)
     */
    private $vegetal;

    /**
     * @var float
     *
     * @ORM\Column(name="woody", type="float", precision=10, scale=0, nullable=true)
     */
    private $woody;

    /**
     * @var boolean
     *
     * @ORM\Column(name="add_prefix", type="boolean", nullable=true)
     */
    private $addPrefix;

    /**
     * @var boolean
     *
     * @ORM\Column(name="azo", type="boolean", nullable=true)
     */
    private $azo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bio", type="boolean", nullable=true)
     */
    private $bio;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cocoa_horizons_program", type="boolean", nullable=true)
     */
    private $cocoaHorizonsProgram;

    /**
     * @var boolean
     *
     * @ORM\Column(name="decantation", type="boolean", nullable=true)
     */
    private $decantation;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fairtrade_sourcing_prog_cocoa", type="boolean", nullable=true)
     */
    private $fairtradeSourcingProgCocoa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fairtrade", type="boolean", nullable=true)
     */
    private $fairtrade;

    /**
     * @var boolean
     *
     * @ORM\Column(name="from_natural_origin", type="boolean", nullable=true)
     */
    private $fromNaturalOrigin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="lenotre", type="boolean", nullable=true)
     */
    private $lenotre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="made_with_100percent_purecocoa_butter", type="boolean", nullable=true)
     */
    private $madeWith100percentPurecocoaButter;

    /**
     * @var boolean
     *
     * @ORM\Column(name="made_with_finest_cocoa_beans", type="boolean", nullable=true)
     */
    private $madeWithFinestCocoaBeans;

    /**
     * @var boolean
     *
     * @ORM\Column(name="made_with_natural_vanilla", type="boolean", nullable=true)
     */
    private $madeWithNaturalVanilla;

    /**
     * @var boolean
     *
     * @ORM\Column(name="new", type="boolean", nullable=true)
     */
    private $new;

    /**
     * @var boolean
     *
     * @ORM\Column(name="non_azo", type="boolean", nullable=true)
     */
    private $nonAzo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="organic", type="boolean", nullable=true)
     */
    private $organic;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rain_forest_alliance", type="boolean", nullable=true)
     */
    private $rainForestAlliance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="standard", type="boolean", nullable=true)
     */
    private $standard;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sustainable_cocoa", type="boolean", nullable=true)
     */
    private $sustainableCocoa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sustainable_palm_mass_balance", type="boolean", nullable=true)
     */
    private $sustainablePalmMassBalance;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sustainable_palm_traceable", type="boolean", nullable=true)
     */
    private $sustainablePalmTraceable;

    /**
     * @var boolean
     *
     * @ORM\Column(name="utz_mass_balance_full_100percent", type="boolean", nullable=true)
     */
    private $utzMassBalanceFull100percent;

    /**
     * @var boolean
     *
     * @ORM\Column(name="without_licithine", type="boolean", nullable=true)
     */
    private $withoutLicithine;

    /**
     * @var string
     *
     * @ORM\Column(name="based", type="string", length=255, nullable=true)
     */
    private $based;

    /**
     * @var string
     *
     * @ORM\Column(name="chocolate_type", type="string", length=255, nullable=true)
     */
    private $chocolateType;

    /**
     * @var string
     *
     * @ORM\Column(name="cocoa_intensity", type="string", length=255, nullable=true)
     */
    private $cocoaIntensity;

    /**
     * @var integer
     *
     * @ORM\Column(name="fluidity", type="integer", nullable=true)
     */
    private $fluidity;

    /**
     * @var string
     *
     * @ORM\Column(name="melting_profile", type="string", length=255, nullable=true)
     */
    private $meltingProfile;

    /**
     * @var string
     *
     * @ORM\Column(name="ph", type="string", length=255, nullable=true)
     */
    private $ph;

    /**
     * @var string
     *
     * @ORM\Column(name="prominent_descriptor", type="string", length=64, nullable=true)
     */
    private $prominentDescriptor;

    /**
     * @var string
     *
     * @ORM\Column(name="provenance", type="string", length=255, nullable=true)
     */
    private $provenance;

    /**
     * @var integer
     *
     * @ORM\Column(name="roast_level", type="integer", nullable=true)
     */
    private $roastLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="size_type", type="string", length=20, nullable=true)
     */
    private $sizeType;

    /**
     * @var string
     *
     * @ORM\Column(name="texture", type="string", length=255, nullable=true)
     */
    private $texture;

    /**
     * @var string
     *
     * @ORM\Column(name="vegetable_fat", type="string", length=255, nullable=true)
     */
    private $vegetableFat;

    /**
     * @var string
     *
     * @ORM\Column(name="cacao_butter_percentage_range", type="string", length=64, nullable=true)
     */
    private $cacaoButterPercentageRange;

    /**
     * @var string
     *
     * @ORM\Column(name="colour", type="string", length=255, nullable=true)
     */
    private $colour;

    /**
     * @var string
     *
     * @ORM\Column(name="composition", type="string", length=255, nullable=true)
     */
    private $composition;

    /**
     * @var string
     *
     * @ORM\Column(name="dosage", type="string", length=255, nullable=true)
     */
    private $dosage;

    /**
     * @var string
     *
     * @ORM\Column(name="fineness", type="string", length=255, nullable=true)
     */
    private $fineness;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=255, nullable=true)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="product_type", type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @var string
     *
     * @ORM\Column(name="water_activity", type="string", length=255, nullable=true)
     */
    private $waterActivity;

    /**
     * @var string
     *
     * @ORM\Column(name="wizard_name", type="string", length=255, nullable=true)
     */
    private $wizardName;

    /**
     * @var integer
     *
     * @ORM\Column(name="nut_sugar_ratio_nut", type="integer", nullable=true)
     */
    private $nutSugarRatioNut;

    /**
     * @var integer
     *
     * @ORM\Column(name="nut_sugar_ratio_sugar", type="integer", nullable=true)
     */
    private $nutSugarRatioSugar;

    /**
     * @var string
     *
     * @ORM\Column(name="length", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $length;

    /**
     * @var string
     *
     * @ORM\Column(name="width", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="diameter", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $diameter;

    /**
     * @var string
     *
     * @ORM\Column(name="capacity_g", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $capacityG;

    /**
     * @var string
     *
     * @ORM\Column(name="capacity_ml", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $capacityMl;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\ProductApplicationEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeApplication",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Application_id", referencedColumnName="id")
     *   }
     * )
     */
    private $application;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\ColorEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeColor",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Color_id", referencedColumnName="id")
     *   }
     * )
     */
    private $color;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\ProductDownloadEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeDownload",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Download_id", referencedColumnName="id")
     *   }
     * )
     */
    private $download;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\SeasonEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeSeason",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Season_id", referencedColumnName="id")
     *   }
     * )
     */
    private $season;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\SegmentEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeSegment",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Segment_id", referencedColumnName="id")
     *   }
     * )
     */
    private $segment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\SKUEntity", mappedBy="recipe", cascade={"persist"})
     */
    private $sku;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\SubbrandEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeSubbrand",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Subbrand_id", referencedColumnName="id")
     *   }
     * )
     */
    private $subbrand;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\TechniqueEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeTechnique",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Technique_id", referencedColumnName="id")
     *   }
     * )
     */
    private $technique;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\TestimonialEntity", inversedBy="recipe", fetch="EAGER")
     * @ORM\JoinTable(name="RecipeTestimonial",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Testimonial_id", referencedColumnName="id")
     *   }
     * )
     */
    private $testimonial;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->application = new \Doctrine\Common\Collections\ArrayCollection();
        $this->color = new \Doctrine\Common\Collections\ArrayCollection();
        $this->download = new \Doctrine\Common\Collections\ArrayCollection();
        $this->season = new \Doctrine\Common\Collections\ArrayCollection();
        $this->segment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sku = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subbrand = new \Doctrine\Common\Collections\ArrayCollection();
        $this->technique = new \Doctrine\Common\Collections\ArrayCollection();
        $this->testimonial = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

