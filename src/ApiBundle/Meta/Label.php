<?php

namespace ApiBundle\Meta;

Trait Label
{
	protected function getColumnLabel(string $column, array $columnTranslations) : string {
		if (array_key_exists($column, $columnTranslations)) {
			return 't(' . $columnTranslations[$column] . ')';
		}

		return $this->getTitle($column);
	}

	protected function getValueLabel(string $column, string $value, array $valueTranslations, array $valueLabels = []) : string {
		if (array_key_exists($column, $valueTranslations)) {
			if (array_key_exists($value, $valueTranslations[$column])) {
				return 't(' . $valueTranslations[$column][$value] . ')';
			}
		}

		if (array_key_exists($column, $valueLabels)) {
			if (array_key_exists($value, $valueLabels[$column])) {
				return $valueLabels[$column][$value];
			}
		}

		return $this->getTitle($value);
	}

	protected function getTitle(string $string) : string {
		$array = explode("_", $string);
		$return = '';
		for ($n = 0; $n < count($array); $n++) {
			if ($n > 0 && $n < count($array)) {
				$return .= ' ';
			}
			$return .= ucwords($array[$n]);
		}

		return $return;
	}
}
