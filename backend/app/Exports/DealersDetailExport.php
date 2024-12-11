<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class DealersDetailExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    protected $keys = [
        'service_id',
        'dealer_name',
        'dealer_phone_no',
        'product_type',
        'product_name',
        'customer_name',
        'amount',
        'payment_mode',
        'amount_received_date',
        'payment_status',
    ];
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        $data = collect($this->data)->map(function ($item) {
            return collect($this->keys)->mapWithKeys(function ($key) use ($item) {
                return [$key => $item[$key] ?? null];
            });
        });

        $totalAmount = $data->sum('amount');

        $data->push([
            'service_id' => null,
            'dealer_name' => null,
            'dealer_phone_no' => null,
            'product_type' => null,
            'product_name' => null,
            'customer_name' => 'Total Expense',
            'amount' => $totalAmount,
            'payment_mode' => null,
            'amount_received_date' => null,
            'payment_status' => null,
        ]);

        return $data;
    }
    public function headings(): array
    {
        return [
            'Service ID',
            'Dealers Name',
            'Dealers Phone no',
            'Product Type',
            'Product Name',
            'Customer Name',
            'Amount',
            'Payment Mode',
            'Payment Date',
            'Status',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        // Set bold font and background color for the heading row
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'FFFF00', // Yellow background color
                ],
            ],
        ]);

        // Calculate the last row based on data size
        $lastRow = count($this->data) + 2; // +2 to include heading row and total row

        // Apply borders to the entire table (including headings and data)
        $sheet->getStyle("A1:J$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Black border
                ],
            ],
        ]);

        // Style the total row
        $sheet->getStyle("A$lastRow:J$lastRow")->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'D9EDF7', // Light blue background color for total row
                ],
            ],
        ]);

        return [];
    }   
}
