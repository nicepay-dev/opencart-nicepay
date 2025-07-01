<?php
class ModelExtensionPaymentNicepayEwallet extends Model {
    public function saveEwalletData($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "order_ewallet SET order_id = '" . (int)$data['order_id'] . "', trx_id = '" . $this->db->escape($data['trx_id']) . "', reference_no = '" . $this->db->escape($data['reference_no']) . "', amount = '" . (float)$data['amount'] . "', created_at = NOW() ");
    }
}