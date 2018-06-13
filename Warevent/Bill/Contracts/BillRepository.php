<?php

namespace Warevent\Bill\Contracts;

interface BillRepository {
	
	/**
	 * Get all bills
	 */
	public function allBills();

	/**
	 * Process payment for bill
	 *
	 * @param      int    $billId
	 * @param      array  $paymentData
	 */
	public function processPayment(int $billId,  array $paymentData);

	/**
	 * Gets the bill payments.
	 *
	 * @param      int   $billId
	 */
	public function getBillPayments(int $billId);

	public function getBillDetails(int $billId);
}