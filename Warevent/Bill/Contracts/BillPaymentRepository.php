<?php

namespace Warevent\Bill\Contracts;

interface BillPaymentRepository {
	
	/**
	 * Record payment for the bill
	 *
	 * @param      array  $params  
	 */
	public function recordPayment(array $params);

	/**
	 * Gets the payments for bill.
	 *
	 * @param      integer  $billId  
	 */
	public function getPaymentsForBill(int $billId);
}