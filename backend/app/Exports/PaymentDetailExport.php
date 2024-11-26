<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PaymentDetailExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $data;

    protected $keys = [
        'service_id',
        'product_type',
        'product_name',
        'customer_name',
        'amount',
        'payment_mode',
        'payment_date',
        'payment_status',
    ];

    // Accept data via the constructor
    public function __construct($data)
    {
        $this->data = $data;
    }

    // Return the data collection for the Excel file
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
            'product_type' => null,
            'product_name' => null,
            'customer_name' => 'Total',
            'amount' => $totalAmount,
            'payment_mode' => null,
            'payment_date' => null,
            'payment_status' => null,
        ]);

        return $data;
    }

    // Define column headings
    public function headings(): array
    {
        return [
            'Service ID',
            'Product Type',
            'Product Name',
            'Customer Name',
            'Amount',
            'Payment Mode',
            'Payment Date',
            'Status',
        ];
    }

    // Apply styles to the worksheet
    public function styles(Worksheet $sheet)
    {
        // Set bold font and background color for the heading row
        $sheet->getStyle('A1:H1')->applyFromArray([
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
        $sheet->getStyle("A1:H$lastRow")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Black border
                ],
            ],
        ]);

        // Style the total row
        $sheet->getStyle("A$lastRow:H$lastRow")->applyFromArray([
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
