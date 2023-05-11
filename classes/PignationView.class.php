<?php

class PignationView extends Pignation{


    public function viewAllPurchaseHistory($recordsPerPage, $query){
        $records_per_page=$recordsPerPage;
        $paginate = new Pignation();
        $newquery = $paginate->paging($query,$records_per_page);
        $paginate->viewTransHistoryLoop($newquery);
        $paginate->paginationLinkNumbers($query,$records_per_page);
    }


}