<?php
namespace ApiBundle\Component;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

/**
 * Custom CamelCase to Underscore name converter.
 */
class CustomCamelCaseConverter implements NameConverterInterface
{
    /**
     * @var array|null
     */
    private $attributes;

    /**
     * @var bool
     */
    private $lowerCamelCase;

    /**
     * @param null|array $attributes     The list of attributes to rename or null for all attributes
     * @param bool       $lowerCamelCase Use lowerCamelCase style
     */
    public function __construct(array $attributes = null, $lowerCamelCase = true)
    {
        $this->attributes = $attributes;
        $this->lowerCamelCase = $lowerCamelCase;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($propertyName)
    {
        if (null === $this->attributes || in_array($propertyName, $this->attributes)) {
            if ($propertyName === 'madeWith100percentPurecocoaButter') {
                return 'made_with_100percent_purecocoa_butter';
            }
            if ($propertyName === 'utzMassBalanceFull100percent') {
                return 'utz_mass_balance_full_100percent';
            }

            return strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($propertyName)));
        }

        return $propertyName;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($propertyName)
    {
        $camelCasedName = preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
            return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
        }, $propertyName);

        if ($this->lowerCamelCase) {
            $camelCasedName = lcfirst($camelCasedName);
        }

        if (null === $this->attributes || in_array($camelCasedName, $this->attributes)) {
            return $camelCasedName;
        }

        return $propertyName;
    }
}
