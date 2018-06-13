<?php

namespace Warevent\Bill\Repositories;

use Warevent\Bill\Contracts\BillRepository;
use Warevent\Bill\Queries\BillItemsQuery;
use Warevent\Bill\Contracts\BillPaymentRepository as BillPayment;
use Warevent\Base\Repositories\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Models\Bill;

class BillEloquentRepository extends BaseEloquentRepository implements BillRepository {

	protected $model;
	protected $billPayment;

	public function __construct(Bill $bill,BillPayment $billPayment)
	{
		parent::__construct($bill);
		$this->model = $bill;
		$this->billPayment = $billPayment;
	}

	/**
	 * Get all the bills
	 *
	 * @return Collection
	 */
	public function allBills() : Collection
	{
		$organizationId = config('app.organization'); 
        return $this->model
                ->where('bills.corp_id',$organizationId)
                ->leftJoin('contacts as c','bills.contact_id','c.contact_id')
                ->get();
	}

	/**
	 * Gets the bill details.
	 *
	 * @param      integer  $billId  
	 *
	 * @return     json   
	 */
	public function getBillDetails(int $billId)
	{
		$bill = $this->findById($billId);
		$billItems = BillItemsQuery::run($billId);

        return response()->json(['bill' => $bill, 'items' => $billItems],200);
	}

	public function processPayment(int $billId, array $paymentData)
	{
		$amountReceived = $paymentData['bill_payment_amount'];

		$this->recordPayment($paymentData)->updateBalance($billId, $amountReceived);
				
        return response()->json(['msg' => 'Payment has been added !','code' => 200],200);
	}

	public function getBillPayments(int $billId) : Collection
	{
		return $this->billPayment->getPaymentsForBill($billId);
	}

	public function recordPayment($data)  : BillEloquentRepository
	{
		$this->billPayment->recordPayment($data);
		return $this;
	}


	public function updateBalance($billId, $amountReceived) : Bill
	{
		$bill = $this->findById($billId);

        // update balance
        $remainingBalance = $bill->bill_balance_due - $amountReceived;
        $bill->bill_balance_due = $remainingBalance;
        $bill->bill_status = 'Partially Paid';

        if( $remainingBalance < 1 ) {
            // paid
            $bill->bill_status = 'Paid';
        }
        $bill->save();	
       return $bill;
   	}
	
}