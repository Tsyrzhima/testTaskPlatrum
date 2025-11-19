<?php
/**
 * @param int[] $ids
 * @return array
 */
public function loadUsersByIds(array $ids): array {
    $idsFilter = $this->_getInCondition('id', $ids);
    return $this->_loadObjectsByFilter('user', [$idsFilter]);
}
private function _getInCondition(string $field, array $values): string {
    if (count($values) === 0) {
        return '0';
    }
    $uniqueValues = array_unique(array_filter($values));
    $quotedValues = array_map(fn(string $value) =>
    $this->_quoteString($value), $uniqueValues);
    $implodedValues = implode(', ', $quotedValues);
    $quotedField = "`{$field}`";
    return "({$quotedField} IN ({$implodedValues}) AND {$quotedField} IS
NOT NULL)";
}
private function _quoteString(string $value): string {
    $conn = new PDO('');
    return $conn->quote($value);
}
private function _loadObjectsByFilter(string $objectName, array $filter
= []): array {
//some PDO work, result query will be SELECT * FROM $objectName WHERE
    ($filter[0]) AND ($filter[1]) ... AND ($filer[n])
return [];
}
