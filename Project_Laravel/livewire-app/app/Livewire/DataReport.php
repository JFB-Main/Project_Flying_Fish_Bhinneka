<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service_LogsModel;
use App\Models\StatusModel;
use App\Models\Status_updatelogModel;
use App\Models\User;

class DataReport extends Component
{
    public $searchFromDateIn;

    public $searchToDateIn;

    public $searchFromCompleted;

    public $searchToCompleted;

    // public function generateStatusHistoryReport()
    // {
    //     // Fetch all service logs with their related status updates,
    //     // and eager load the status type and teknisi name for each update.
    //     // Order status updates by creation date to correctly track iterations.
    //     $serviceLogs = Service_LogsModel::with([
    //         'statusUpdateLog_bind' => function ($query) {
    //             $query->orderBy('created_at', 'asc');
    //         },
    //         'statusUpdateLog_bind.status',
    //         'statusUpdateLog_bind.technician'
    //     ]);

    //     if ($this->searchFromDateIn && $this->searchToDateIn) {

    //         $toDateForQuery = $this->searchToDateIn . ' 23:59:59'; 

    //         $serviceLogs->whereBetween('date_in', [$this->searchFromDateIn, $toDateForQuery]);
    //     }
    //     // conditions for when only one date is provided
    //     elseif ($this->searchFromDateIn) {
    //         $serviceLogs->where('date_in', '>=', $this->searchFromDateIn);
    //     }
    //     elseif ($this->searchToDateIn) {
    //         $serviceLogs->where('date_in', '<=', $this->searchToDateIn . ' 23:59:59');
    //     }

        
    //     if ($this->searchFromCompleted && $this->searchToCompleted) {

    //         $toCompletedForQuery = $this->searchToCompleted . ' 23:59:59'; 

    //         $serviceLogs->whereBetween('completed_date', [$this->searchFromCompleted, $toCompletedForQuery]);
    //     }
    //     elseif ($this->searchFromCompleted) {
    //         $serviceLogs->where('completed_date', '>=', $this->searchFromCompleted);
    //     }
    //     elseif ($this->searchToCompleted) {
    //         $serviceLogs->where('completed_date', '<=', $this->toCompletedForQuery . ' 23:59:59');
    //     }

    //     $serviceLogs = $serviceLogs->take(3)->get();



    //     $reportData = [];

    //     // Define status IDs for easy lookup (assuming these IDs are fixed as per your INSERT statement)
    //     $statusMap = [
    //         1 => 'Open',
    //         2 => 'On Progress',
    //         3 => 'Pending',
    //         4 => 'RMA to Vendor',
    //         5 => 'On-QC',
    //         6 => 'Completed',
    //         7 => 'Canceled',
    //         8 => 'Returned to Client',
    //     ];

    //     foreach ($serviceLogs as $log) {
    //         // Initialize a row for the report with default null values
    //         $row = [
    //             'Techlog ID' => $log->techlog_id,
    //             'Date In' => $log->date_in ? \Carbon\Carbon::parse($log->date_in)->format('Y-m-d') : null, // Format date
    //             'Customer Name' => $log->received_from, // Assuming this column exists
    //             'Brand Type' => $log->brand_type, // Assuming this column exists
    //             'Serial Number' => $log->serial_number, // Assuming this column exists
    //             // Initialize all status-specific columns to null
    //             'On-Progress User' => null, 'On-Progress Date' => null,
    //             'Pending 1 User' => null, 'Pending 1 Date' => null,
    //             'Pending 2 User' => null, 'Pending 2 Date' => null,
    //             'Pending 3 User' => null, 'Pending 3 Date' => null,
    //             'RMA to Vendor 1 User' => null, 'RMA to Vendor 1 Date' => null,
    //             'RMA to Vendor 2 User' => null, 'RMA to Vendor 2 Date' => null,
    //             'RMA to Vendor 3 User' => null, 'RMA to Vendor 3 Date' => null,
    //             'On-QC 1 User' => null, 'On-QC 1 Date' => null,
    //             'On-QC 2 User' => null, 'On-QC 2 Date' => null,
    //             'On-QC 3 User' => null, 'On-QC 3 Date' => null,
    //             'Complete User' => null, 'Complete Date' => null,
    //             'Return to Client User' => null, 'Return to Client Date' => null,
    //         ];

    //         // Counters for iterative statuses
    //         $pendingCount = 0;
    //         $rmaCount = 0;
    //         $qcCount = 0;

    //         foreach ($log->statusUpdateLog_bind as $update) {
    //             $statusType = $statusMap[$update->status_id] ?? 'Unknown'; // Get status type from map
    //             $userName = $update->technician->username ?? 'N/A'; // Get teknisi name
    //             $updateDate = \Carbon\Carbon::parse($update->created_at)->format('Y-m-d H:i:s');

    //             switch ($statusType) {
    //                 case 'On Progress':
    //                     // Only take the first instance for single-entry columns
    //                     if (is_null($row['On-Progress User'])) {
    //                         $row['On-Progress User'] = $userName;
    //                         $row['On-Progress Date'] = $updateDate;
    //                     }
    //                     break;
    //                 case 'Pending':
    //                     $pendingCount++;
    //                     if ($pendingCount <= 3) {
    //                         $row['Pending ' . $pendingCount . ' User'] = $userName;
    //                         $row['Pending ' . $pendingCount . ' Date'] = $updateDate;
    //                     }
    //                     break;
    //                 case 'RMA to Vendor':
    //                     $rmaCount++;
    //                     if ($rmaCount <= 3) {
    //                         $row['RMA to Vendor ' . $rmaCount . ' User'] = $userName;
    //                         $row['RMA to Vendor ' . $rmaCount . ' Date'] = $updateDate;
    //                     }
    //                     break;
    //                 case 'On-QC':
    //                     $qcCount++;
    //                     if ($qcCount <= 3) {
    //                         $row['On-QC ' . $qcCount . ' User'] = $userName;
    //                         $row['On-QC ' . $qcCount . ' Date'] = $updateDate;
    //                     }
    //                     break;
    //                 case 'Completed':
    //                     if (is_null($row['Complete User'])) { // Only record the first time it becomes 'Completed'
    //                         $row['Complete User'] = $userName;
    //                         $row['Complete Date'] = $updateDate;
    //                     }
    //                     break;
    //                 case 'Returned to Client':
    //                     if (is_null($row['Return to Client User'])) { // Only record the first time it becomes 'Returned to Client'
    //                         $row['Return to Client User'] = $userName;
    //                         $row['Return to Client Date'] = $updateDate;
    //                     }
    //                     break;
    //                 // 'Open' and 'Canceled' are not explicitly in the requested report columns for history
    //             }
    //         }
    //         $reportData[] = $row;
    //     }

    //     return $reportData;
    // }
    
    // public function copyTableContent()
    // {
    //     $this->dispatch('copy-table-content', tableId: 'myTableContent');
    // }


    public function render()
    {

        // Fetch all service logs with their related status updates,
        // and eager load the status type and teknisi name for each update.
        // Order status updates by creation date to correctly track iterations.
        $serviceLogs = Service_LogsModel::with([
            'statusUpdateLog_bind' => function ($query) {
                $query->orderBy('created_at', 'asc');
            },
            'statusUpdateLog_bind.status',
            'statusUpdateLog_bind.technician'
        ]);

        if ($this->searchFromDateIn && $this->searchToDateIn) {

            $toDateForQuery = $this->searchToDateIn . ' 23:59:59'; 

            $serviceLogs->whereBetween('date_in', [$this->searchFromDateIn, $toDateForQuery]);
        }
        // conditions for when only one date is provided
        elseif ($this->searchFromDateIn) {
            $serviceLogs->where('date_in', '>=', $this->searchFromDateIn);
        }
        elseif ($this->searchToDateIn) {
            $serviceLogs->where('date_in', '<=', $this->searchToDateIn . ' 23:59:59');
        }

        
        if ($this->searchFromCompleted && $this->searchToCompleted) {

            $toCompletedForQuery = $this->searchToCompleted . ' 23:59:59'; 

            $serviceLogs->whereBetween('completed_date', [$this->searchFromCompleted, $toCompletedForQuery]);
        }
        elseif ($this->searchFromCompleted) {
            $serviceLogs->where('completed_date', '>=', $this->searchFromCompleted);
        }
        elseif ($this->searchToCompleted) {
            $serviceLogs->where('completed_date', '<=', $this->toCompletedForQuery . ' 23:59:59');
        }

        $serviceLogs = $serviceLogs->get();



        $reportData = [];

        // Define status IDs for easy lookup (assuming these IDs are fixed as per your INSERT statement)
        $statusMap = [
            1 => 'Open',
            2 => 'On Progress',
            3 => 'Pending',
            4 => 'RMA to Vendor',
            5 => 'On-QC',
            6 => 'Completed',
            7 => 'Canceled',
            8 => 'Returned to Client',
        ];

        foreach ($serviceLogs as $log) {
            // Initialize a row for the report with default null values
            $row = [
                'Techlog ID' => $log->techlog_id,
                'Date In' => $log->date_in ? \Carbon\Carbon::parse($log->date_in)->format('Y-m-d') : null, // Format date
                'Customer Name' => $log->received_from, // Assuming this column exists
                'Brand Type' => $log->brand_type, // Assuming this column exists
                'Serial Number' => $log->serial_number, // Assuming this column exists
                // Initialize all status-specific columns to null
                'On-Progress User' => null, 'On-Progress Date' => null,
                'Pending 1 User' => null, 'Pending 1 Date' => null,
                'Pending 2 User' => null, 'Pending 2 Date' => null,
                'Pending 3 User' => null, 'Pending 3 Date' => null,
                'RMA to Vendor 1 User' => null, 'RMA to Vendor 1 Date' => null,
                'RMA to Vendor 2 User' => null, 'RMA to Vendor 2 Date' => null,
                'RMA to Vendor 3 User' => null, 'RMA to Vendor 3 Date' => null,
                'On-QC 1 User' => null, 'On-QC 1 Date' => null,
                'On-QC 2 User' => null, 'On-QC 2 Date' => null,
                'On-QC 3 User' => null, 'On-QC 3 Date' => null,
                'Complete User' => null, 'Complete Date' => null,
                'Return to Client User' => null, 'Return to Client Date' => null,
            ];

            // Counters for iterative statuses
            $pendingCount = 0;
            $rmaCount = 0;
            $qcCount = 0;

            foreach ($log->statusUpdateLog_bind as $update) {
                $statusType = $statusMap[$update->status_id] ?? 'Unknown'; // Get status type from map
                $userName = $update->technician->username ?? 'N/A'; // Get teknisi name
                $updateDate = \Carbon\Carbon::parse($update->created_at)->format('Y-m-d H:i:s');

                switch ($statusType) {
                    case 'On Progress':
                        // Only take the first instance for single-entry columns
                        if (is_null($row['On-Progress User'])) {
                            $row['On-Progress User'] = $userName;
                            $row['On-Progress Date'] = $updateDate;
                        }
                        break;
                    case 'Pending':
                        $pendingCount++;
                        if ($pendingCount <= 3) {
                            $row['Pending ' . $pendingCount . ' User'] = $userName;
                            $row['Pending ' . $pendingCount . ' Date'] = $updateDate;
                        }
                        break;
                    case 'RMA to Vendor':
                        $rmaCount++;
                        if ($rmaCount <= 3) {
                            $row['RMA to Vendor ' . $rmaCount . ' User'] = $userName;
                            $row['RMA to Vendor ' . $rmaCount . ' Date'] = $updateDate;
                        }
                        break;
                    case 'On-QC':
                        $qcCount++;
                        if ($qcCount <= 3) {
                            $row['On-QC ' . $qcCount . ' User'] = $userName;
                            $row['On-QC ' . $qcCount . ' Date'] = $updateDate;
                        }
                        break;
                    case 'Completed':
                        if (is_null($row['Complete User'])) { // Only record the first time it becomes 'Completed'
                            $row['Complete User'] = $userName;
                            $row['Complete Date'] = $updateDate;
                        }
                        break;
                    case 'Returned to Client':
                        if (is_null($row['Return to Client User'])) { // Only record the first time it becomes 'Returned to Client'
                            $row['Return to Client User'] = $userName;
                            $row['Return to Client Date'] = $updateDate;
                        }
                        break;
                    // 'Open' and 'Canceled' are not explicitly in the requested report columns for history
                }
            }
            $reportData[] = $row;
        }

        // $generator = new DataReport();
        // $reportData = $generator->generateStatusHistoryReport();
        return view('livewire.data-report', ['reportData' => $reportData])->extends('specific')->section('dataReportContent');
    }
}
