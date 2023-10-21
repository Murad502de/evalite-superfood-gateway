<?php

namespace App\Http\Controllers;

use App\Traits\PdfTrait;
use PDF;

class PDFController extends Controller
{
    use PdfTrait;

    public function preview()
    {
        return view('test');
    }

    public function generatePDFv1()
    {
        return PDF::loadView('agency_contract')
            ->setPaper('a4')
            ->download('Агентский договор на поиск клиентов.pdf');
    }

    public function generatePDFv2()
    {
        $path             = base_path('resources/img/signature.jpg');
        $type             = pathinfo($path, PATHINFO_EXTENSION);
        $data             = file_get_contents($path);
        $signature_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf_data = [
            'number'                             => '8-23/9-D-ru',
            'date'                               => '11.10.2023',
            'signature_base64'                   => $signature_base64,
            'partner_full_name'                  => 'Эвалайт Эвалайт Эвалайт',
            'partner_registration_address'       => '352690, Россия, Краснодарский край, Апшеронский р-н, г Апшеронск, ул. Фрунзе, д 90',
            'partner_inn'                        => '236802411681',
            'partner_ogrnip'                     => '316236800058347',
            'partner_checking_account'           => '40802810200003601872',
            'partner_bank'                       => 'АО "ТИНЬКОФФ БАНК"',
            'partner_bank_inn'                   => '7710140679',
            'partner_bank_bic'                   => '044525974',
            'partner_bank_correspondent_account' => '30101810145250000974',
            'partner_bank_legal_address'         => 'Москва, 127287, ул. Хуторская 2-я, д. 38А, стр. 26',
        ];

        return $this->loadViewStream('agency_contract_v2', $pdf_data, "8-23/9-D-ru");
    }
}
