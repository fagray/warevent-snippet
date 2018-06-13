<?php

namespace Warevent\Bill\Repositories;

use Warevent\Bill\Contracts\BillPaymentRepository;
use Warevent\Base\Repositories\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Models\BillPayment;

class BillPaymentEloquentRepository extends BaseEloquentRepository implements BillPaymentRepository {

	protected $model;

	public function __construct(BillPayment $bill)
	{
		parent::__construct($bill);
		$this->model = $bill;
	}

	public function recordPayment(array $paymentData) : BillPayment
	{
		return $this->model->create($paymentData);
	}

	public function getPaymentsForBill(int $billId) : Collection
	{
		return $this->model->where('bill_id',$billId)->get();
	}

	
}