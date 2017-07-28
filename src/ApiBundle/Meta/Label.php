<?php

namespace ApiBundle\Meta;

trait Label
{
	protected $appId;
	protected $table;

	protected function getLabels(string $table) : array {
		$columnTranslation = $this->getDoctrine()->getRepository('ApiBundle:ColumntranslationEntity')->findByAppTable(5, $table);
		$valueTranslation = $this->getDoctrine()->getRepository('ApiBundle:ValuetranslationEntity')->findByAppTable(5, $table);
		$fieldDescription = $this->getDoctrine()->getRepository('ApiBundle:FielddescriptionEntity')->findByTable($table);

		return [
			'ColumnTranslation' => $columnTranslation,
			'ValueTranslation' => $valueTranslation,
			'FieldDescription' => $fieldDescription
		];
	}

	protected function getColumnTranslationLabel(string $table, string $column, array $columnTranslations) : string {
		if (array_key_exists($column, $columnTranslations)) {
			return 't(' . $columnTranslations[$column] . ')';
		}

		return $this->getTitle($column);
	}

	protected function getValueTranslationLabel(string $column, string $value, array $valueTranslations, array $valueLabels = []) : string {
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
