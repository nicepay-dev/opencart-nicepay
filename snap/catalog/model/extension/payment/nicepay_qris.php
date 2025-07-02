<?php
class ModelExtensionPaymentNicepayQris extends Model {
    public function addQrisTransaction(array $data): void {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "order_qris` SET 
            `order_id` = '" . (int)$data['order_id'] . "', 
            `trx_id` = '" . $this->db->escape($data['trx_id']) . "', 
            `amount` = '" . $this->db->escape($data['amount']) . "', 
            `qr_url` = '" . $this->db->escape($data['qr_url']) . "', 
            `created_at` = NOW()");
    }

    public function getQrisTransactionByTrxId(string $trx_id): ?array {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_qris` WHERE `trx_id` = '" . $this->db->escape($trx_id) . "' LIMIT 1");

        return $query->row ?: null;
    }

    public function getQrisTransactionByOrderId(int $order_id): ?array {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_qris` WHERE `order_id` = '" . (int)$order_id . "' LIMIT 1");

        return $query->row ?: null;
    }

    public function updateQrisStatus(string $trx_id, string $status): void {
        $this->db->query("UPDATE `" . DB_PREFIX . "order_qris` SET `status` = '" . $this->db->escape($status) . "' WHERE `trx_id` = '" . $this->db->escape($trx_id) . "'");
    }
}
