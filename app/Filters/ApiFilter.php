<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}


// class ApiFilter
// {
//     protected $safeParams = [
//         'name' => ['eq'],
//         'type' => ['eq'],
//         'email' => ['eq'],
//         'address' => ['eq'],
//         'city' => ['eq'],
//         'state' => ['eq'],
//         'postalCode' => ['eq', 'gt', 'lt']
//     ];

//     protected $columnMap = [
//         'postalCode' => 'postal_code'
//     ];

//     protected $operatorMap = [
//         'eq' => '=',
//         'lt' => '<',
//         'gt' => '>',
//         'lte' => '≤',
//         'gte' => '≥'
//     ];

//     public function transform(Request $request)
//     {
//         $eloQuery = [];

//         foreach ($this->safeParams as $param => $operators) {
//             $query = $request->query($param);

//             if (!isset($query)) {
//                 continue;
//             }

//             $column = $this->columnMap[$param] ?? $param;

//             foreach ($operators as $operator) {
//                 if (isset($query[$operator])) {
//                     $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
//                 }
//             }
//         }

//         return $eloQuery;
//     }
// }
