<?php
/**
 * @param array $data webhook body
 * @return void
 */
public function processWebhook(array $data): void {
    $type = $data['type'] ?? null;
    if ($type !== 'message') {
        throw new Exception('Unsupported type');
    }
    $message = $data['text'] ?? null;
    $fields = $data['fields'] ?? [];
    if ($message === null) {
        throw new Exception('Text cannot be empty');
    }
    $this->_storeDeal(
        'Deal from webhook',
        $message,
        json_encode($fields),
    );
}

private function _storeDeal(string $title, string $text, array $fields, ?string
                                   $externalId = null): void {
//some logic to store Deal in database
}
private function _setDataToCache(string $key, array $data, int $expires): void {
//save data to cache with expire time (in seconds)
}
private function _getDealByExternalId(string $externalId): ?array {
//returns deal from db if its exists, if not - returns null
    return [];
}
private function _getDataFromCache(string $key): ?string {
//returns data from cache by key
    return null;
}