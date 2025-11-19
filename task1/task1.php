<?php
/**
 * @param int[] $ids
 * @return array
 */
public function loadUsersByIds(array $ids): array {

    if (empty($ids)) {
        return [];
    }
    $conn = $this->getConnection();
    $ids = array_unique($ids);
    $chunkSize = 5000;
    $result = [];

    foreach (array_chunk($ids, $chunkSize) as $chunk) {
        $placeholders = implode(',', array_fill(0, count($chunk), '?'));
        $sql = "SELECT * FROM user WHERE id IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($chunk);

        foreach ($stmt->fetchAll() as $row) {
            $result[] = $row;
        }
    }
    return $result;
}
private function getConnection(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=testdb;charset=utf8',
            'user',
            'pass',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }

    return $pdo;
}

SHOW VARIABLES;
...
long_query_time 10.000000
low_priority_updates OFF
lower_case_file_system ON
lower_case_table_names 2
max_allowed_packet 16M
max_binlog_cache_size 18446744073709547520
max_binlog_size 1073741824
max_binlog_stmt_cache_size 18446744073709547520
max_connect_errors 10
max_connections 151
max_delayed_threads 20
max_error_count 64
max_heap_table_size 16777216
max_insert_delayed_threads 20
max_join_size 18446744073709551615
max_length_for_sort_data 1024
max_long_data_size 1048576
max_prepared_stmt_count 16382
