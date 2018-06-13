<?php

namespace Warevent\Bill\Queries;

use Warevent\Base\Repositories\BaseEloquentRepository;
use Illuminate\Support\Collection;

class BillItemsQuery extends BaseEloquentRepository  {


	/**
    Get bill items  
     *
     * @param      integer     $billId  
     *
     * @return     Collection  
     */
    public static function run(int $billId) : Collection
	{

       return 
            \DB::table('bill_items as bi')
                ->where('bi.bill_id',$billId)
                ->leftJoin('bills as b','bi.bill_id','b.bill_id')
                ->leftJoin('items as it','bi.item_id','it.item_id')
                ->leftJoin('businesses as bu','b.contact_id','bu.buss_id')
                ->leftJoin('units as u','it.unit_id','u.unit_id')
                ->leftJoin('warehouses as w','b.whouse_id','w.whouse_id')
                ->get();
	}

	
}