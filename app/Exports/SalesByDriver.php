<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SalesByDriver implements FromView, WithStyles, ShouldAutoSize
{
    public $reports;
    public $networkArea;
    public $dateFrom;
    public $dateTo;
    public $sheet;

    //The constructor passes by value
    public function __construct($data, $networkArea, $dateFrom, $dateTo){
        $this->reports = $data;
        $this->networkArea = $networkArea;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    public function view(): View
    {
        //dd( $this->reports);
        return view('exports.salesbydriver', [
            'reports' => $this->reports,
            'networkArea' => $this->networkArea,
            'dateFrom' => $this->dateFrom,
            'dateTo' => $this->dateTo,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        $highestRow = $sheet->getHighestRow();
        $sheet->getStyle('A1:AH' . $highestRow)->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:AH' . $highestRow)->applyFromArray($styleArray);
        return $sheet;
    }
}
