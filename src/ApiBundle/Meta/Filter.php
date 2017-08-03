<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Transform;

trait Filter
{
	use Transform;

	protected function getFilters(array &$answer, array $entityData, $entityMap, array $entityFilterData) : void {
		foreach ($entityData as $key => $value) {
			$key = $this->camelCaseToUnderscore($key);
			if (!is_array($value)) {
				$value = $this->nullify($value);
			}

			if ($value) {
				foreach ($entityFilterData as $filterType => $attributes) {
					if (in_array($key, $attributes)) {
						if (!array_key_exists($key, $answer)) {
							$answer[$key] = [
								'label' => $key,
								'type' => $filterType
							];
						}

						switch ($filterType) {
							case 'boolean':
								$answer[$key]['options'] = 'true';
								break;
							case 'float':
								if (!array_key_exists('options', $answer[$key])) {
									$answer[$key]['options'] = [
										'min' => '',
										'max' => ''
									];
								}
								if ($answer[$key]['options']['min'] === '' || $value < $answer[$key]['options']['min']) {
									$answer[$key]['options']['min'] = (string)$value;
								}
								if ($answer[$key]['options']['max'] === '' || $value > $answer[$key]['options']['max']) {
									$answer[$key]['options']['max'] = (string)$value;
								}
								break;
							case 'enum':
								if (!array_key_exists('options', $answer[$key])) {
									$answer[$key]['options'] = [];
								}
								if (!is_array($value) && !array_key_exists($value, $answer[$key]['options'])) {
									$answer[$key]['options'][strtolower($value)] = $value;
								}
								if (is_array($value)) {
									if (count($value) === count($value, COUNT_RECURSIVE)) {
										$value = [$value];
									}

									foreach ($value as $relation) {
										if (!array_key_exists($relation['id'], $answer[$key]['options'])) {
											$answer[$key]['options'][$relation['id']] = $relation['id'];
										}
									}
								}
								break;
							case 'relation':
								$relationEntityClass = 'ApiBundle\\EntityMap\\' . $entityMap->getRelationClass($key);
								$relationEntityMap = new $relationEntityClass();
								$relationEntityFilterData = [];

								foreach ($relationEntityMap->getFilterTypes() as $relationFilterType) {
									$relationEntityFilterData[$relationFilterType] = $relationEntityMap->getFiltersByType($relationFilterType);
								}

								foreach ($value as $relationEntityData) {
									$this->getFilters($answer, $relationEntityData, $relationEntityMap, $relationEntityFilterData);
								}
								
								break;
	 					}
					}
				}
			}
		}
	}
}
