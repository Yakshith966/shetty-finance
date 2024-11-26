<?php

// app/Exports/CustomerDetailsExport.php
namespace App\Exports;

use App\Models\CustomerExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;


class CustomerExports implements FromCollection, WithHeadings,WithStyles, WithTitle, WithCustomStartCell
{
    protected $customers;

    // Pass the customer data through the constructor
    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    public function collection()
    {
        return $this->customers;  // Return the customers passed from the controller
    }

    public function headings(): array
    {
        return [
            'Customer ID',
            'Customer Name',
            'Phone Number',
            'Email',
            'Alternate Phone Number'
        ];
    }
    public function startCell(): string
    {
        return 'A3'; // Data will start from row 3
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->customers->count(); // Get the number of rows in the dataset
        $lastRow = $rowCount + 3;
        // Set the title "Customer Details" in A1:E1
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'Customer Details');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 20,
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // Apply styles to column headers (row 3)
        $sheet->getStyle('A3:E3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
            'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'], // Black color
            ],
        ],
        ]);
        for ($row = 4; $row <= $lastRow; $row++) {
        $sheet->getStyle("A$row:E$row")->applyFromArray([ // Assuming up to 1000 rows of data
            'font' => [
                
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => 'left', // Align data to the left
                'vertical' => 'center',
            ],
            'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'], // Black color
            ],
        ],
        ]);
    }
    
        // Adjust column widths for better visibility
        foreach (range('A', 'E') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return $sheet;
    }

    public function title(): string
    {
        return 'Customer Details'; // Set sheet title
    }
}
